------------- raw queries


// summary report query
    
SELECT 
     ap.app_id
    ,ap.app_code
    ,ap.app_year
    ,ap.description ap_desc
    ,apj.app_no
    ,apj.app_proj_name
    ,pp.project_name
    ,pp.end_user
    ,pp.proc_mode
    ,pp.ib_rei
    ,pp.open_bids
    ,pp.notice_awards
    ,pp.contract_signing
    ,pp.delivery
    ,pp.source_funds
    ,pp.total
    ,ifnull((pp.total + av.amount) - ae.amount,0) AS remains
FROM app ap
    LEFT JOIN app_proj apj ON apj.app_id = ap.app_id
    LEFT JOIN procurement_projects pp ON pp.app_no = apj.app_proj_id
    LEFT JOIN (SELECT * FROM additionals_v) av ON av.proj_id = pp.proj_id
    LEFT JOIN app_entry ae ON ae.proj_id = pp.proj_id;






















----------------------


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `app_ins`(`p_app_code` VARCHAR(50)
                                                    , `p_app_no` VARCHAR(50)
                                                    , `p_app_year` INT
                                                    , `p_description` TEXT
                                                    , `p_created_by` INT
                                                    , OUT `p_app_id` INT
                                                    , OUT `p_err_code` VARCHAR(10)
                                                    , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_app_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = 'Module code already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_app_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    INSERT INTO app
        ( app_code
        , app_no
        , app_year
        , description
        , created_by
        , creation_date)
    VALUES ( p_app_code
           , p_app_no
           , p_app_year
           , p_description
           , p_created_by
           , NOW()
	);

    SET p_app_id = LAST_INSERT_ID();
    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;




----------------------




DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `app_upd`(`p_app_id` INT
                                                    , `p_app_year` TEXT
                                                    , `p_app_code` TEXT
                                                    , `p_description` TEXT
                                                    , `p_user_id` INT
                                                    , OUT `p_err_code` VARCHAR(10)
                                                    , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_err_code  = '1';
        SET p_err_msg = 'APP code already exists for this year';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    UPDATE app
    SET
         app_code = p_app_code
        ,app_year = p_app_year
        ,description = p_description
        ,updated_by = p_user_id
        ,update_date = NOW()
    WHERE app_id = p_app_id;


    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;




-------------------------------------------------------



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proj_ins`(`p_app_id` INT
                                                     , `p_app_code` VARCHAR(50)
                                                     , `p_app_no` VARCHAR(50)
                                                     , `p_description` TEXT
                                                     , `p_user_id` INT
                                                     , OUT `p_proj_id` INT
                                                     , OUT `p_err_code` VARCHAR(10)
                                                     , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_proj_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = 'APP number already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_proj_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    INSERT INTO app_proj
        ( app_id
        , app_code
        , app_no
        , app_proj_name
        , created_by
        , creation_date)
    VALUES ( p_app_id
           , p_app_code
           , p_app_no
           , p_description
           , p_user_id
           , NOW()
    );

    SET p_proj_id = LAST_INSERT_ID();
    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;



-------------------------------------------------------





DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proj_upd`(`p_app_proj_id` INT
                                                     , `p_app_no` VARCHAR(50)
                                                     , `p_app_proj_name` VARCHAR(50)
                                                     , `p_user_id` INT
                                                     , OUT `p_err_code` VARCHAR(10)
                                                     , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_err_code  = '1';
        SET p_err_msg = 'APP number already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    UPDATE app_proj
    SET 
         app_no = p_app_no
        ,app_proj_name = p_app_proj_name
    WHERE app_proj_id = p_app_proj_id;

    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;






-----------------------------------------------------


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ins`(`p_app_id` INT
                                                     , `p_app_no` VARCHAR(50)
                                                     , `p_proj_name` VARCHAR(50)
                                                     , `p_end_user` TEXT
                                                     , `p_proc_mode` TEXT
                                                     , `p_ib_rei` TEXT
                                                     , `p_open_bids` TEXT
                                                     , `p_notice_awards` TEXT
                                                     , `p_contract_signing` TEXT
                                                     , `p_delivery` TEXT
                                                     , `p_source_funds` TEXT
                                                     , `p_total` DOUBLE
                                                     , `p_mooe` DOUBLE
                                                     , `p_user_id` INT
                                                     , OUT `p_proj_id` INT
                                                     , OUT `p_err_code` VARCHAR(10)
                                                     , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_proj_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = 'APP number already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_proj_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    INSERT INTO procurement_projects
        ( app_id
        , app_no
        , project_name
        , end_user
        , proc_mode
        , ib_rei
        , open_bids
        , notice_awards
        , contract_signing
        , delivery
        , source_funds
        , total
        , mooe
        , created_by
        , creation_date)
    VALUES ( p_app_id
           , p_app_no
           , p_proj_name
           , p_end_user
           , p_proc_mode
           , p_ib_rei
           , p_open_bids
           , p_notice_awards
           , p_contract_signing
           , p_delivery
           , p_source_funds
           , p_total
           , p_mooe
           , p_user_id
           , NOW()
    );

    SET p_proj_id = LAST_INSERT_ID();
    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;



-------------------------------------------------------


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_alloc_ins`(`p_app_id` INT
                                                         , `p_app_code` VARCHAR(50)
                                                         , `p_proj_id` INT
                                                         , `p_amount` DOUBLE
                                                         , `p_user_id` INT
                                                         , OUT `p_app_add_id` INT
                                                         , OUT `p_err_code` VARCHAR(10)
                                                         , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_app_add_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = 'APP number already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_app_add_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    INSERT INTO app_additionals
        ( app_id
        , app_code
        , proj_id
        , amount
        , created_by
        , creation_date)
    VALUES ( p_app_id
           , p_app_code
           , p_proj_id
           , p_amount
           , p_user_id
           , NOW()
    );

    SET p_app_add_id = LAST_INSERT_ID();
    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;



-------------------------------------------------------



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `entry_ins`(`p_app_id` INT
                                                         , `p_app_proj_id` INT
                                                         , `p_proj_id`  INT
                                                         , `p_entry_type` TEXT
                                                         , `p_particulars` TEXT
                                                         , `p_amount` DOUBLE
                                                         , `p_year` TEXT
                                                         , `p_user_id` INT
                                                         , OUT `p_entry_id` INT
                                                         , OUT `p_err_code` VARCHAR(10)
                                                         , OUT `p_err_msg` VARCHAR(250))
BEGIN

    DECLARE EXIT HANDLER FOR 1062, 1586
    BEGIN
        SET p_entry_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = 'APP number already exists';
    END;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
        SET p_entry_id = NULL;
        SET p_err_code  = '1';
        SET p_err_msg = CONCAT('ERR:',@errno,' - ',@text);
    END;

    SET @app_code = (SELECT app_code FROM app WHERE app_id = p_app_id);
    SET @app_no = (SELECT app_no FROM app_proj WHERE app_proj_id = p_app_proj_id);

    INSERT INTO app_entry
        ( app_id
        , app_code
        , app_proj_id
        , app_no
        , proj_id
        , entry_type
        , amount
        , particulars
        , year
        , created_by
        , creation_date)
    VALUES ( p_app_id
           , @app_code
           , p_app_proj_id
           , @app_no
           , p_proj_id
           , p_entry_type
           , p_amount
           , p_particulars
           , p_year
           , p_user_id
           , NOW()
    );

    SET p_entry_id = LAST_INSERT_ID();
    SET p_err_code = NULL;
    SET p_err_msg = NULL;

END$$
DELIMITER ;
