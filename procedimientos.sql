--Procedimiento para registrar un nuevo usuario
drop procedure registrar_usuario;
create procedure registrar_usuario(NAMEP varchar(50),secretP varchar(50),numeroP varchar(50),correo varchar(50))
 begin
 DECLARE ap varchar(50);
 DECLARE maxid int;
 DECLARE maxcod_usuario int;
 set maxid=((select max(id) from sip_buddies)+1);
 set maxcod_usuario=((select max(cod) from usuarios)+1);
 set ap=concat('SIP/',numeroP,',60');
 
 insert into usuarios(nick,pasword) 
  values(NAMEP,secretP);

 INSERT INTO sip_buddies(
 NAME, defaultuser, secret, context, HOST, nat, qualify, TYPE,cod_usuario)
 VALUES 	
 (numeroP, NAMEP, secretP, 'from-sip', 'dynamic', 'yes', 'no', 'friend',maxcod_usuario);

 insert  into extensions(`context`,`exten`,`priority`,`app`,`appdata`,`id_sip`) 
  values 
  ('from-sip',numeroP,1,'Dial',ap,maxid);

 INSERT INTO asteriskrealtime.voicemail_users 
 (customer_id,  context,  mailbox,  PASSWORD,   fullname,   email ) 
 VALUES 
 (numeroP,   'from-sip',   numeroP, secretP ,  NAMEP, correo);  
end;

call registrar_usuario('PERCY','sistemas','2001',"correo@gmail.com");

drop table usuarios;
create table usuarios(
   cod int primary key AUTO_INCREMENT,
   nick varchar(50),
   pasword varchar(50)
);
drop table empleados;
create table empleados(
  ci int primary key,
  nombre varchar(50),
  apellidoP varchar(50),
  apellidoM varchar(50),
  sexo char(1),
  departamento varchar(50),
  fecha_reg date,
  cod_usuario int,
  foreign key(cod_usuario) references usuarios(cod)
);


 drop table sip_buddies;
 CREATE TABLE `sip_buddies` (
 `id` int(11) NOT NULL auto_increment,
 `name` varchar(80) NOT NULL,
 `callerid` varchar(80) default NULL,
 `defaultuser` varchar(80) NOT NULL,
 `regexten` varchar(80) NOT NULL,
 `secret` varchar(80) default NULL,
 `mailbox` varchar(50) default NULL,
 `accountcode` varchar(20) default NULL,
 `context` varchar(80) default NULL,
 `amaflags` varchar(7) default NULL,
 `callgroup` varchar(10) default NULL,
 `canreinvite` char(3) default 'yes',
 `defaultip` varchar(15) default NULL,
 `dtmfmode` varchar(7) default NULL,
 `fromuser` varchar(80) default NULL,
 `fromdomain` varchar(80) default NULL,
 `fullcontact` varchar(80) default NULL,
 `host` varchar(31) NOT NULL,
 `insecure` varchar(4) default NULL,
 `language` char(2) default NULL,
 `md5secret` varchar(80) default NULL,
 `nat` varchar(5) NOT NULL default 'no',
 `deny` varchar(95) default NULL,
 `permit` varchar(95) default NULL,
 `mask` varchar(95) default NULL,
 `pickupgroup` varchar(10) default NULL,
 `port` varchar(5) NOT NULL,
 `qualify` char(3) default NULL,
 `restrictcid` char(1) default NULL,
 `rtptimeout` char(3) default NULL,
 `rtpholdtimeout` char(3) default NULL,
 `type` varchar(6) NOT NULL default 'friend',
 `disallow` varchar(100) default 'all',
 `allow` varchar(100) default 'g729;ilbc;gsm;ulaw;alaw',
 `musiconhold` varchar(100) default NULL,
 `regseconds` int(11) NOT NULL default '0',
 `ipaddr` varchar(15) NOT NULL,
 `cancallforward` char(3) default 'yes',
 `lastms` int(11) NOT NULL,
 `useragent` char(255) default NULL,
 `regserver` varchar(100) default NULL,
 cod_usuario int,
 foreign key (cod_usuario) references usuarios(cod),
 PRIMARY KEY  (`id`),
 UNIQUE KEY `name` (`name`),
 KEY `name_2` (`name`)
 ) ENGINE=MyISAM AUTO_INCREMENT=893 DEFAULT CHARSET=latin1;

 drop table extensions;
 CREATE TABLE `extensions` (
  `id` int(11) NOT NULL auto_increment,
  `context` varchar(20) NOT NULL default '',
  `exten` varchar(20) NOT NULL default '',
  `priority` tinyint(4) NOT NULL default '0',
  `app` varchar(20) NOT NULL default '',
  `appdata` varchar(128) NOT NULL default '',
  `id_sip` int,
  foreign key (id_sip) references sip_buddies(id),
  PRIMARY KEY  (`context`,`exten`,`priority`),
  KEY `id` (`id`)
  ) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;

   drop table voicemail_users;
   CREATE TABLE `voicemail_users` (
  `uniqueid` int(11) NOT NULL auto_increment,
  `customer_id` varchar(11) NOT NULL default '0',
  `context` varchar(50) NOT NULL,
  `mailbox` varchar(11) NOT NULL default '0',
  `password` varchar(5) NOT NULL default '0',
  `fullname` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pager` varchar(50) NOT NULL,
  `tz` varchar(10) NOT NULL default 'central',
  `attach` varchar(4) NOT NULL default 'yes',
  `saycid` varchar(4) NOT NULL default 'yes',
  `dialout` varchar(10) NOT NULL,
  `callback` varchar(10) NOT NULL,
  `review` varchar(4) NOT NULL default 'no',
  `operator` varchar(4) NOT NULL default 'no',
  `envelope` varchar(4) NOT NULL default 'no',
  `sayduration` varchar(4) NOT NULL default 'no',
  `saydurationm` tinyint(4) NOT NULL default '1',
  `sendvoicemail` varchar(4) NOT NULL default 'no',
  `delete` varchar(4) NOT NULL default 'no',
  `nextaftercmd` varchar(4) NOT NULL default 'yes',
  `forcename` varchar(4) NOT NULL default 'no',
  `forcegreetings` varchar(4) NOT NULL default 'no',
  `hidefromdir` varchar(4) NOT NULL default 'yes',
  `stamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`uniqueid`),
  KEY `mailbox_context` (`mailbox`,`context`)
  ) ENGINE=MyISAM AUTO_INCREMENT=2001 DEFAULT CHARSET=latin1;


CREATE TABLE `queue_table` (
  `name` varchar(128) NOT NULL,
  `musiconhold` varchar(128) default NULL,
  `announce` varchar(128) default NULL,
  `context` varchar(128) default NULL,
  `timeout` int(11) default NULL,
  `monitor_join` tinyint(1) default NULL,
  `monitor_format` varchar(128) default NULL,
  `queue_youarenext` varchar(128) default NULL,
  `queue_thereare` varchar(128) default NULL,
  `queue_callswaiting` varchar(128) default NULL,
  `queue_holdtime` varchar(128) default NULL,
  `queue_minutes` varchar(128) default NULL,
  `queue_seconds` varchar(128) default NULL,
  `queue_lessthan` varchar(128) default NULL,
  `queue_thankyou` varchar(128) default NULL,
  `queue_reporthold` varchar(128) default NULL,
  `announce_frequency` int(11) default NULL,
  `announce_round_seconds` int(11) default NULL,
  `announce_holdtime` varchar(128) default NULL,
  `retry` int(11) default NULL,
  `wrapuptime` int(11) default NULL,
  `maxlen` int(11) default NULL,
  `servicelevel` int(11) default NULL,
  `strategy` varchar(128) default NULL,
  `joinempty` varchar(128) default NULL,
  `leavewhenempty` varchar(128) default NULL,
  `eventmemberstatus` tinyint(1) default NULL,
  `eventwhencalled` tinyint(1) default NULL,
  `reportholdtime` tinyint(1) default NULL,
  `memberdelay` int(11) default NULL,
  `weight` int(11) default NULL,
  `timeoutrestart` tinyint(1) default NULL,
  `periodic_announce` varchar(50) default NULL,
  `periodic_announce_frequency` int(11) default NULL,
  `ringinuse` tinyint(1) default NULL,
  `setinterfacevar` tinyint(1) default NULL,
  PRIMARY KEY  (`name`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
 CREATE TABLE `queue_member_table` (
  `uniqueid` int(10) unsigned NOT NULL auto_increment,
  `membername` varchar(40) default NULL,
  `queue_name` varchar(128) default NULL,
  `interface` varchar(128) default NULL,
  `penalty` int(11) default NULL,
  `paused` int(11) default NULL,
  PRIMARY KEY  (`uniqueid`),
  UNIQUE KEY `queue_interface` (`queue_name`,`interface`)
  ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
   
   CREATE TABLE `meetme` (
  `confno` varchar(80) NOT NULL default '0',
  `username` varchar(64) NOT NULL default '',
  `domain` varchar(128) NOT NULL default '',
  `pin` varchar(20) default NULL,
  `adminpin` varchar(20) default NULL,
  `members` int(11) NOT NULL default '0',
  PRIMARY KEY  (`confno`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

alter table extensions add id_sip int foreign key (id_sip) references sip_buddies(id)

--Vista de usuarios
drop view v_usuarios;
create view v_usuarios
	as
select sip_buddies.id as cod,name as Nombre,exten as Numero 
from sip_buddies,extensions,usuarios
where sip_buddies.id=extensions.id_sip
and usuarios.cod=sip_buddies.cod_usuario;

drop view vista_usuarios;
create view vista_usuarios
  as
  select cod,nick,pasword from usuarios;

drop view v_buzon_de_voz;
--Vista buzon de voz
create view v_buzon_de_voz
as
select customer_id as cod, mailbox, PASSWORD, fullname,  email  
from voicemail_users; 

 