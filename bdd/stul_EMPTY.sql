drop table if exists STUL_COMMENT;

drop table if exists STUL_OPTIONS;

drop table if exists STUL_POST;

drop table if exists STUL_USERS;

drop table if exists STUL_CATEGORY;

drop table if exists STUL_LOG;

drop table if exists STUl_VISITES;

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
   POST_DATE            datetime,
   CATEGORY_ID          int,
   POST_STATUS          smallint,
   POST_TYPE            smallint,
   POST_TITLE           text,
   POST_CONTENT         text,
   POST_TAG             text,
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
	jour				date not null,
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

ALTER TABLE  STUL_USERS ADD UNIQUE (USER_DISPLAYNAME);

alter table STUL_COMMENT add constraint FK_A foreign key (POST_ID)
      references STUL_POST (POST_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_COMMENTE foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_EST_PARENT foreign key (COM_PARENT)
      references STUL_COMMENT (COM_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_EST_L_AUTEUR foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_APPARTIENT foreign key (CATEGORY_ID)
      references STUL_CATEGORY (CATEGORY_ID) on delete restrict on update restrict;

alter table STUL_LOG add constraint FK_LOG foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

