drop procedure registrar_usuario;
create procedure registrar_usuario(NAMEP varchar(50),secretP varchar(50),numeroP varchar(50))
 begin
 DECLARE ap varchar(50);
 DECLARE maxid int;
 set maxid=((select max(id) from sip_buddies)+1);
 set ap=concat('SIP/',NAMEP,',60');
 select ap as 's';
 INSERT INTO sip_buddies(
 NAME, defaultuser, secret, context, HOST, nat, qualify, TYPE)
 VALUES 	
 (NAMEP, NAMEP, secretP, 'from-sip', 'dynamic', 'yes', 'no', 'friend');

 insert  into extensions(`context`,`exten`,`priority`,`app`,`appdata`,`id_sip`) 
  values 
  ('from-sip',numeroP,1,'Dial',ap,maxid);
end;
call registrar_usuario('PERCY','sistemas','2001');


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

alter table extensions add id_sip int foreign key (id_sip) references sip_buddies(id)

drop view v_usuarios;
create view v_usuarios
	as
select sip_buddies.id,name,exten from sip_buddies,extensions
where sip_buddies.id=extensions.id_sip;