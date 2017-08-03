SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

IF (OBJECT_ID('ISCO_CONDOMINIO') IS NOT NULL)
  DROP PROCEDURE ISCO_CONDOMINIO
GO

CREATE PROCEDURE [dbo].[ISCO_CONDOMINIO]
	@i_id nvarchar(20),
	@i_usuario nvarchar(20) WITH ENCRYPTION 
AS 
	DECLARE @i_numerod varchar(20), @i_codesta varchar(10), @i_codusua varchar(10),
	@i_codvend varchar(10), @i_codubic varchar(10), @i_descrip varchar(60), @i_codclie varchar(15),
	@i_direc1 varchar(60), @i_id3 varchar(25), @i_monto decimal(28,4), @i_mtotax decimal(28,4), 
	@i_tgravable decimal(28,4), @i_texento decimal(28,4), @i_costoprd decimal(28,4), @i_costosrv decimal(28,4), 
	@i_desctop decimal(28,4), @i_fechae datetime, @i_mtototal decimal(28,4), @i_contado decimal(28,4), @i_credito decimal(28,4), 
	@i_totalprd decimal(28,4), @i_totalsrv decimal(28,4),@i_serv bit,@x_codtax varchar(10),@x_tgravable decimal(28,4),
	@i_nota1 varchar(60), @i_nota2 varchar(60), @i_nota3 varchar(60), @i_nota4 varchar(60),
	@i_nota5 varchar(60), @i_nota6 varchar(60), @i_nota7 varchar(60), @i_nota8 varchar(60),
	@i_nota9 varchar(60), @i_pocentaje decimal(28,4), @i_calculo decimal(28,4), @i_linea int,
	@i_coditem varchar(15), @i_ditem varchar(40), @i_cantidad decimal(28,4), @i_titem decimal(28,4), @i_precio decimal(28,4), 
	@i_taxitem decimal(28,4), @i_refere varchar(40), @d_total decimal(28,4), @d_precio decimal(28,4), @d_tax decimal(28,4),
	@c_total decimal(28,4), @c_precio decimal(28,4), @c_tax decimal(28,4),	@c_tgravable decimal(28,4), @c_texento decimal(28,4), 
	@correl varchar(15), @prefijo varchar(15), @valor int, @salida int

SET @prefijo = CONCAT('CO',YEAR(GETDATE()));
SET @i_fechae = GETDATE();
SET @c_texento = 0;
SET @c_tgravable = 0;

SELECT @valor = (SELECT count(*) FROM SAFACT WHERE Notas10 = @i_id and TipoFac='F')
  IF (@valor = 0)
  BEGIN
	BEGIN TRY
		BEGIN TRAN Condominio
		DECLARE safact_Cursor CURSOR FOR  
		SELECT NumeroD,CodEsta,CodUsua,CodVend,CodUbic,Direc1,ID3,Monto,MtoTax,TGravable,TExento,CostoPrd,CostoSrv,DesctoP,FechaI,FechaE,
			FechaV,MtoTotal,Contado,Credito,TotalPrd,TotalSrv,Notas1,Notas2,Notas3,Notas4,Notas5,Notas6,Notas7,Notas8,Notas9
			FROM SAFACT WHERE NumeroD = @i_id and TipoFac='F';  
		OPEN safact_Cursor;  
		FETCH NEXT FROM safact_Cursor into @i_numerod,@i_codesta,@i_codusua,@i_codvend,@i_codubic,@i_direc1,@i_id3,@i_monto,@i_mtotax, 
		@i_tgravable,@i_texento,@i_costoprd,@i_costosrv,@i_desctop,@i_fechae,@i_fechae,@i_fechae,@i_mtototal,@i_contado,@i_credito,@i_totalprd,@i_totalsrv,
		@i_nota1,@i_nota2,@i_nota3,@i_nota4,@i_nota5,@i_nota6,@i_nota7,@i_nota8,@i_nota9

		DECLARE alicuota_Cursor cursor for
		SELECT s.CodClie,s.Direc1,s.Descrip,a.porcentaje,s.ID3 
			FROM ISCO_ALICUOTA a, SACLIE s 
			WHERE s.CodClie=a.CodClie
		OPEN alicuota_Cursor
		FETCH NEXT FROM alicuota_Cursor into @i_codclie,@i_direc1,@i_descrip,@i_pocentaje,@i_id3
		WHILE @@FETCH_STATUS = 0
		BEGIN
			SET @c_precio = 0;
			SET @c_tax = 0;
			SET @c_total = 0;
		
			INSERT INTO ISCO_CORRELATIVO(NumeroD,prefijo)
			VALUES (@i_id,@prefijo) 
			SET @correl=CONCAT(@prefijo,SCOPE_IDENTITY());

			INSERT INTO SAFACT(CodSucu,TipoFac,NumeroD,CodEsta,CodUsua,CodVend,CodUbic,CodClie,Descrip,Direc1,ID3,Monto,MtoTax,TGravable,TExento,CostoPrd,CostoSrv,DesctoP,FechaI,
					FechaE,FechaV,MtoTotal,Contado,Credito,TotalPrd,TotalSrv,Notas10,Factor) VALUES ('00000','F',@correl,@i_codesta,
					@i_codusua,@i_codvend,@i_codubic,@i_codclie,@i_descrip,@i_direc1,@i_id3,0,0,0,0,0,0,0,@i_fechae,@i_fechae,@i_fechae,0,0,0,0,0,@i_id,1);   
			/****************************************************** SAITEMFAC *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT NroLinea,CodItem,Descrip1,Refere,Cantidad,TotalItem,Precio,MtoTax,EsServ 
				FROM SAITEMFAC
				WHERE NumeroD = @i_id and TipoFac='F';  
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_linea,@i_coditem,@i_ditem, @i_refere, @i_cantidad, @i_titem, @i_precio, @i_taxitem, @i_serv
			WHILE @@FETCH_STATUS = 0
			BEGIN
				SET @d_precio = (@i_precio*@i_pocentaje)/100;
				SET @d_total = (@i_titem*@i_pocentaje)/100;
				if (@i_taxitem>0) 
				  BEGIN
					SET @d_tax = (@i_taxitem*@i_pocentaje)/100;
					SET @c_tgravable = @c_tgravable + (@i_cantidad*@d_precio);
				  END
				ELSE
				  BEGIN
					SET @d_tax = 0;
					SET @c_texento = @c_texento + (@i_cantidad*@d_precio);
				  END;
				
				SET @c_precio = @c_precio + @d_precio
				SET @c_tax = @c_tax + @d_tax
				SET @c_total = @c_total + @d_total

				INSERT INTO SAITEMFAC(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,CodVend,Descrip1,Refere,Signo,CantMayor,Cantidad,TotalItem,Precio,MtoTax,PriceO,FechaE,EsServ)
						VALUES ('00000','F',@correl,@i_linea,0,@i_coditem,@i_codubic,@i_codvend,@i_ditem,@i_refere,1,@i_cantidad,@i_cantidad,@d_total,@d_precio,@d_tax,@d_precio,@i_fechae,@i_serv);   
				FETCH NEXT FROM saitemfac_Cursor into @i_linea,@i_coditem,@i_ditem, @i_refere, @i_cantidad, @i_titem, @i_precio, @i_taxitem, @i_serv
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor; 
			/****************************************************** SATAXITF *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT NroLinea,CodTaxs,CodItem,Monto,TGravable,MtoTax
				FROM SATAXITF
				WHERE NumeroD = @i_id and TipoFac='F';  
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_linea,@x_codtax,@i_coditem,@i_titem, @x_tgravable, @i_taxitem
			WHILE @@FETCH_STATUS = 0
			BEGIN
				SET @d_precio = (@x_tgravable*@i_pocentaje)/100;
				SET @d_total = (@i_titem*@i_pocentaje)/100;
			
				INSERT INTO SATAXITF(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodTaxs,Monto,TGravable,MtoTax)
						VALUES ('00000','F',@correl,@i_linea,0,@i_coditem,@x_codtax,@d_total,@d_precio,@i_taxitem);   
				FETCH NEXT FROM saitemfac_Cursor into @i_linea,@x_codtax,@i_coditem,@i_titem, @x_tgravable, @i_taxitem
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor;
			/****************************************************** SATAXVTA *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT sum(Monto) as Monto, sum(TGravable) as TGravable,CodTaxs,MtoTax
				FROM SATAXITF 
				WHERE TipoFac='F' and NumeroD=@correl
				group by CodTaxs,MtoTax
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_titem,@x_tgravable,@x_codtax,@i_taxitem
			WHILE @@FETCH_STATUS = 0
			BEGIN
				INSERT INTO SATAXVTA(CodSucu,TipoFac,NumeroD,CodTaxs,Monto,TGravable,MtoTax,EsReten)
						VALUES ('00000','F',@correl,@x_codtax,@i_titem,@x_tgravable,@i_taxitem,1);   
				FETCH NEXT FROM saitemfac_Cursor into @i_titem,@x_tgravable,@x_codtax,@i_taxitem
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor;
			/*************************************************************************************************************************/
			UPDATE SAFACT 
				SET Monto=@c_precio, MtoTax=@c_tax,TGravable=@c_tgravable,TExento=@c_texento,MtoTotal=@c_total,Credito=@c_total,TotalPrd=@c_precio
				WHERE NumeroD=@correl and TipoFac='F'
			FETCH NEXT FROM alicuota_Cursor into @i_codclie,@i_direc1,@i_descrip,@i_pocentaje,@i_id3
			/*************************************************************************************************************************/
			INSERT INTO ISCO_PRESUPUESTOS(numerod,usuario) VALUES (@i_id,@i_usuario);
		END
		/****************************************************** UPDATE SAFACT *****************************************************/
		  
		CLOSE safact_Cursor;  
		DEALLOCATE safact_Cursor;  
		CLOSE alicuota_Cursor 
		DEALLOCATE alicuota_Cursor;
		COMMIT TRAN Condominio
		SET @salida = 1;
    END TRY
	BEGIN CATCH
		/*SELECT ERROR_NUMBER() AS errNumber
	       , ERROR_SEVERITY() AS errSeverity 
	       , ERROR_STATE() AS errState
	       , ERROR_PROCEDURE() AS errProcedure
	       , ERROR_LINE() AS errLine
	       , ERROR_MESSAGE() AS errMessage*/
		SET @salida = -1;
		ROLLBACK TRAN Condominio
	END CATCH
  END
  ELSE
	SET @salida = 0;
  SELECT @salida as salida;	
GO