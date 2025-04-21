create table colaborador
(
    id int primary key not null,
    nom varchar(50),
    app varchar(50),
    apm varchar(50),
    tel varchar(50),
    correo varchar(50),
    aux varchar(50),
    fecha date,
    auxtel varchar(50),
    foto varchar(50)
);

create table plantilla
(
    id int primary key not null,
    desc varchar(50)
);

create table historico
(
    id int primary key not null,
    desc varchar(50),
    doc varchar(50),
    fecha date
);