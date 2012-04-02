drop table if exists STUL_COMMENT;

drop table if exists STUL_OPTIONS;

drop table if exists STUL_POST;

drop table if exists STUL_USERS;

create table STUL_COMMENT
(
   COM_ID               int not null auto_increment,
   USER_ID              int,
   POST_ID              int not null,
   _TABLE__PK           int,
   COM_CONTENT          text,
   COM_DATE             datetime,
   primary key (COM_ID)
);

alter table STUL_COMMENT comment 'table de commentaire';

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
   POST_CATEGORY        int,
   POST_STATUS          smallint,
   POST_TYPE            smallint,
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

alter table STUL_USERS comment 'table des utilisateurs';

alter table STUL_COMMENT add constraint FK_A foreign key (POST_ID)
      references STUL_POST (POST_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_COMMENTE foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;

alter table STUL_COMMENT add constraint FK_EST_PARENT foreign key (_TABLE__PK)
      references STUL_COMMENT (COM_ID) on delete restrict on update restrict;

alter table STUL_POST add constraint FK_EST_L_AUTEUR foreign key (USER_ID)
      references STUL_USERS (USER_ID) on delete restrict on update restrict;
