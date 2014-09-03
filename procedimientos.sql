drop procedure usuario_nuevo;

create procedure usuario_nuevo(n varchar(50),p varchar(50))
  begin
    insert into usuarios(nick,pasword) values(n,p);
  end;

call usuario_nuevo("juan","12345");

create view vista_usuarios
  as
  select cod,nick,pasword from usuarios;

create table usuarios(
   cod int primary key AUTO_INCREMENT,
   nick varchar(50),
   pasword varchar(50)
);
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
drop procedure registrar_usuario;
create procedure registrar_usuario(NAMEP varchar(50),secretP varchar(50),numeroP varchar(50),correo varchar(50))
 begin
 DECLARE ap varchar(50);
 DECLARE maxid int;
 set maxid=((select max(id) from sip_buddies)+1);
 set ap=concat('SIP/',numeroP,',60');
 select ap as 's';
 INSERT INTO sip_buddies(
 NAME, defaultuser, secret, context, HOST, nat, qualify, TYPE)
 VALUES 	
 (numeroP, NAMEP, secretP, 'from-sip', 'dynamic', 'yes', 'no', 'friend');

 insert  into extensions(`context`,`exten`,`priority`,`app`,`appdata`,`id_sip`) 
  values 
  ('from-sip',numeroP,1,'Dial',ap,maxid);

 INSERT INTO asteriskrealtime.voicemail_users 
 (customer_id,  context,  mailbox,  PASSWORD,   fullname,   email ) 
 VALUES 
 (numeroP,   'from-sip',   numeroP, secretP ,  NAMEP, correo); 
end;

call registrar_usuario('PERCY','sistemas','2001',"correo@gmail.com");


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
select sip_buddies.id as cod,name as Nombre,exten as Numero from sip_buddies,extensions
where sip_buddies.id=extensions.id_sip;


 