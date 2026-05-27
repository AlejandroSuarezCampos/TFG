DELIMITER $$

CREATE PROCEDURE PA_GENERAR_CODIGO(OUT p_codigo VARCHAR(16))
BEGIN

    DECLARE v_codigo VARCHAR(16);
    DECLARE v_existe INT DEFAULT 1;
    DECLARE v_caracteres VARCHAR(36) DEFAULT 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    DECLARE v_i INT;

    WHILE v_existe > 0 DO

        SET v_codigo = '';
        SET v_i = 0;

        -- Generar código de 16 caracteres
        WHILE v_i < 16 DO

            SET v_codigo = CONCAT(
                v_codigo,
                SUBSTRING(
                    v_caracteres,
                    FLOOR(1 + RAND() * LENGTH(v_caracteres)),
                    1
                )
            );

            SET v_i = v_i + 1;

        END WHILE;

        -- Comprobar si ya existe
        SELECT COUNT(*)
        INTO v_existe
        FROM pedido_item
        WHERE codigo = v_codigo;

    END WHILE;

    SET p_codigo = v_codigo;

END$$

DELIMITER ;