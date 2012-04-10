drop table if exists STUL_COMMENT CASCADE;

drop table if exists STUL_OPTIONS CASCADE;

drop table if exists STUL_POST CASCADE;

drop table if exists STUL_CATEGORY CASCADE;

drop table if exists STUL_LOG CASCADE;

drop table if exists STUl_VISITES CASCADE;

drop table if exists STUL_USERS CASCADE;

drop table if exists STUL_UPLOAD CASCADE;

create table STUL_COMMENT
(
   COM_ID               int not null auto_increment,
   USER_ID              int,
   POST_ID              int not null,
   COM_PARENT           int,
   COM_CONTENT          text,
   COM_DATE             datetime,
   primary key (COM_ID)
);

create table STUL_OPTIONS
(
   OP_ID                int not null auto_increment,
   OP_NAME              varchar(500) not null,
   OP_VALUE             text,
   primary key (OP_ID, OP_NAME)
);

create table STUL_POST
(
   POST_ID              int not null auto_increment,
   USER_ID              int,
   IMG_ID               int,
   POST_DATE            datetime,
   CATEGORY_ID          int,
   POST_STATUS          smallint,
   POST_TYPE            smallint,
   POST_TITLE           text,
   POST_CONTENT         text,
   POST_TAG             text,
   POST_MINIATURE       varchar(100),
   primary key (POST_ID)
);

create table STUL_USERS
(
   USER_ID              int not null auto_increment,
   USER_LOGIN           varchar(100),
   USER_PASS            varchar(100),
   USER_DISPLAYNAME     varchar(100),
   USER_MAIL            varchar(100),
   USER_REGISTERED      datetime,
   USER_STATUS          smallint,
   USER_IP              varchar(16),
   USER_BAN             tinyint,
   primary key (USER_ID)
);

create table STUL_CATEGORY
(
   CATEGORY_ID          int not null auto_increment,
   CATEGORY_NAME        varchar(100),
   CATEGORY_DESC        text,
   primary key (CATEGORY_ID)      
);

create table STUL_VISITES
(
	ID					int not null auto_increment,
	jour				datetime not null,
	primary key(ID)
);

create table STUL_LOG
(
   ID             int not null auto_increment,
   USER_ID        int not null,
   date_connexion   datetime not null,
   date_deconnexion datetime,
   primary key(ID)
);

create table STUL_UPLOAD
(
   UPLOAD_ID         int not null auto_increment,
   upload_filename   varchar(50),
   upload_dir        varchar(500),
   upload_date       datetime,
   upload_type       varchar(10),
   upload_description       text,
   primary key(UPLOAD_ID)
);

ALTER TABLE  STUL_USERS ADD UNIQUE (USER_DISPLAYNAME);

alter table STUL_COMMENT add constraint FK_A foreign key (POST_ID)
      references STUL_POST (POST_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_COMMENTE foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_EST_PARENT foreign key (COM_PARENT)
      references STUL_COMMENT (COM_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_EST_L_AUTEUR foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_EST_L_IMAGE foreign key (IMG_ID)
      references STUL_UPLOAD (UPLOAD_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_APPARTIENT foreign key (CATEGORY_ID)
      references STUL_CATEGORY (CATEGORY_ID) on delete restrict on update restrict;

alter table STUL_LOG add constraint FK_LOG foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

ALTER TABLE STUL_POST  
   ADD CONSTRAINT valeur_par_defaut DEFAULT 1 FOR IMG_ID  
	  
INSERT INTO STUL_CATEGORY(CATEGORY_NAME,CATEGORY_DESC) VALUES('Blog','catégorie news du site'),('News','news du blog');


