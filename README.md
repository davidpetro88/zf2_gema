ZendSkeletonApplication
=======================
URL Serviços
------------

http://zf2.intermediario/admin


-- sonuser
http://zf2.intermediario/auth ( Login )
http://zf2.intermediario/register ( Registrar )
http://zf2.intermediario/auth/logout ( Logout )
http://zf2.intermediario/register/activate/b0f51894777eb51f063316cbc6ff158d  ( Ativando usuário )
http://zf2.intermediario/admin/ ( Admin )
http://zf2.intermediario/admin/users/edit/1
http://zf2.intermediario/admin/users/new

-- sonuser-rest
http://zf2.intermediario/api/user
http://zf2.intermediario/api/user/2

-- sonuser-acl
http://zf2.intermediario/admin/acl
http://zf2.intermediario/admin/acl/roles/edit/1
http://zf2.intermediario/admin/acl/roles/new

-- Doctrine Comandos

./vendor/bin/doctrine-module orm:schema-tool:update --force

./vendor/bin/doctrine-module orm:schema-tool:create --dump-sql

./vendor/bin/doctrine-module data-fixture:import --purge-with-truncate

 ./vendor/bin/doctrine-module data-fixture:import --purge-with-truncate


drop database zf2_intermediario;
create database  zf2_intermediario;
use zf2_intermediario;
select * from sonacl_roles;

use zf2_intermediario;
select * from sonacl_privileges;
select * from sonuser_users;
select * from sonacl_roles; -- role_id 1 - Visitante
select * from sonacl_resources; -- resource_id 5 - Application\Controller\Index\index


created_at
updated_at

insert into sonacl_privileges values ( 5,4,5,'Exclur', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 6,1,5,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 7,1,6,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 8,1,7,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');

insert into sonacl_privileges values ( 9,2,5,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 10,2,6,'Exclur', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 11,2,7,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 12,2,8,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');
insert into sonacl_privileges values ( 13,2,9,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');

insert into sonacl_privileges values ( 14,1,12,'Visualizar', '2015-07-12 12:30:05','2015-07-11 12:30:05');

insert into sonuser_users values (3,2, "Cevoscleu","cevoscleu@gmail.com", "WnMGiHo7","OjfphtTcWUY=",1, "115422fba5806ec09c015ad15e0744cf", "2015-07-11 12:15:59", "2015-07-11 12:15:59");

select * from sonacl_privileges;
select * from sonacl_roles;
select * from sonacl_resources;

update sonacl_resources set nome = "Application\\Controller\\Index\\index"
	where id = 5;
    
insert into sonacl_resources values (5,"Application\\Controller\\Index\\index", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (6,"Auth\\logout", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (7,"Auth\\index", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (8,"Roles\\index", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (9,"roles\\edit", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (10,"roles\\new", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (11,"users\\index", '2015-07-11 12:30:05','2015-07-11 12:30:05');
insert into sonacl_resources values (12,"Index\\register", '2015-07-11 12:30:05','2015-07-11 12:30:05');

/*
sonacl_privileges (Privilegio por Resource "Arquivos". Roles perfis
nome = Visualizar, Novo/Editar, Excluir, Visualizar
role_id = sonacl_role
resource_id = sonacl_resources

sonacl_resources ( Nome dos arquivos.)

sonacl_roles (Perfis de usuário)
parent_id = proprio
nome = Perfil


*/


select * from sonacl_privileges  where role_id = 1 and resource_id = 5;




Materia
- id | matéria
- nome | nome da materia
- conteudo | conteudo da matéria
- status (“PROPOSTA”, “REVISAO”, “APROVADA”, “PUBLICADA” e "ARQUIVADA")
- created_at
- updated_at

sessao
- id | sessao
- nome | nome da sessao
- gerente | gerente da sesso
- created_at
- updated_at


Status_materia
- id   | do status da meteria
- nome | “PROPOSTA”, “REVISAO”, “APROVADA”, “PUBLICADA” e "ARQUIVADA"
