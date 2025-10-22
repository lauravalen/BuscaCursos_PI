/*CODIGO DO BANCO NA SINTAXE DO MYSQL*/


-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS busca_cursos;
USE busca_cursos;

-- Tabela ADMINISTRADOR
CREATE TABLE administrador
(
    adm_id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_adm VARCHAR(80) NOT NULL,
    cpf_adm CHAR(11) NOT NULL UNIQUE ,
    senha_adm VARCHAR(20) NOT NULL,
    -- DATETIME é o tipo padrão para data e hora no MySQL
    data_insercao DATETIME NOT NULL, 
    situacao INT NOT NULL
);

-- Tabela PLATAFORMA
CREATE TABLE plataforma
(
    plataforma_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adm_id INT NOT NULL REFERENCES administrador (adm_id),
    nome_plataforma VARCHAR (80) NOT NULL,
    url_plataforma VARCHAR (255) NOT NULL UNIQUE,
    descricao_plataforma VARCHAR (350) NOT NULL           
);

-- Tabela CATEGORIA
CREATE TABLE categoria
(
    categoria_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(350) NOT NULL,
    data_insercao DATETIME NOT NULL
);

-- Tabela AREACATEGORIA
CREATE TABLE area_categoria(
    area_categoria_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL REFERENCES categoria (categoria_id),
    data_insercao DATETIME NOT NULL,
    situacao INT NOT NULL        
);

-- Tabela CURSO
CREATE TABLE curso
(
    curso_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    area_categoria_id INT NOT NULL REFERENCES area_categoria (area_categoria_id),
    titulo_curso VARCHAR (80) NOT NULL,
    url_curso VARCHAR(255) NOT NULL,
    certificacao VARCHAR(80) NOT NULL,
    -- FLOAT é adequado para o MySQL
    quantidade_horas FLOAT NOT NULL, 
    descricao_curso VARCHAR(350) NOT NULL,
    data_inicio DATETIME NOT NULL,
    nivel_ensino VARCHAR(80) NOT NULL,
    data_insercao DATETIME NOT NULL        
);

-- Tabela USUARIO
CREATE TABLE usuario
(
    usuario_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(80) NOT NULL,
    email_usuario VARCHAR(80) NOT NULL UNIQUE,
    senha_usuario VARCHAR(80) NOT NULL,
    data_insercao DATETIME NOT NULL,
    situacao INT NOT NULL
);

-- Tabela FEEDBACK
CREATE TABLE feedback
(
    feedback_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL REFERENCES usuario (usuario_id),
    titulo_feedback VARCHAR(80) NOT NULL,
    descricao_feedback VARCHAR(250) NOT NULL,
    avaliacao INT NOT NULL,
    data_publicacao DATETIME NOT NULL,
    comentario VARCHAR(250) NOT NULL        
);

-- Tabela MENTOR
CREATE TABLE mentor
(
    mentor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_mentor VARCHAR(80) NOT NULL,
    data_insercao DATETIME NOT NULL,
    situacao INT NOT NULL
);

-- Tabela MENTORIA
CREATE TABLE mentoria
(
    mentoria_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL REFERENCES curso (curso_id),
    plataforma_id INT NOT NULL REFERENCES plataforma (plataforma_id),
    mentor_id INT NOT NULL REFERENCES mentor (mentor_id),
    data_insercao DATETIME NOT NULL,
    situacao INT NOT NULL        
);

-- Tabela PLATAFORMACURSO
CREATE TABLE plataforma_curso
(
    plataforma_curso_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curso_id INT NOT NULL REFERENCES curso (curso_id),
    plataforma_id INT NOT NULL REFERENCES plataforma (plataforma_id)
    -- DATE é o tipo para apenas data no MySQL        
);

-- Tabela HISTORICOUSUARIO
CREATE TABLE historico_usuario
(
    -- Usando AUTO_INCREMENT e corrigindo a referência no CREATE TABLE
    historico_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    data_insercao DATETIME NOT NULL,
    descricao VARCHAR(80) NOT NULL,
    plataforma_curso_id INT NOT NULL REFERENCES plataforma_curso (plataforma_curso_id),
    usuario_id INT NOT NULL REFERENCES usuario (usuario_id),
    curso_id INT NOT NULL REFERENCES curso (curso_id),
    area_categoria_id INT NOT NULL REFERENCES area_categoria (area_categoria_id)        
);

---
-- Comandos INSERT com ajuste no formato de data (YYYY-MM-DD HH:MM:SS)
---

INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, data_insercao, situacao)
    VALUES ('Bianca Mendes', 'biancamendes5847@hotmail.com', '457TS58E', '2025-05-14 20:53:45', 0) 
         ,('Gabrielly Vasconcelos', 'gabriellyvscls7572@gmail.com', 's5T785Ds', '2025-05-14 20:56:45', 0);

INSERT INTO administrador (nome_adm, cpf_adm, senha_adm, data_insercao, situacao)
    VALUES ('Lady Gaga', '49847858948', '12344321ABC', '2025-05-14 21:13:22', 0);

INSERT INTO plataforma (adm_id, nome_plataforma, url_plataforma, descricao_plataforma, quantidade_cursos)
    VALUES (1, 'Curso em vídeo', 'https://www.cursoemvideo.com/cursos/', 'O Curso em Vídeo oferece aulas gratuitas em vídeo nas áreas de informática, programação, marketing e idiomas. Ideal para quem quer aprender de forma prática e no seu ritmo, com certificado disponível em muitos cursos.', 48)
         ,(1, 'IPED', 'https://www.iped.com.br/cursos-gratis', 'O IPED disponibiliza cursos gratuitos em diversas áreas, como saúde, idiomas, marketing, tecnologia e muito mais. Você estuda online, no seu tempo, e pode emitir certificado ao final, caso deseje.', 433) 
         ,(1,'FGV Educação Executiva', 'https://educacao-executiva.fgv.br/', 'A FGV oferece cursos online gratuitos em áreas como administração, direito, finanças e tecnologia, com certificado e estudo no seu ritmo.', 228)
         ,(1,'Fundação Bradesco', 'https://www.ev.org.br/','Na Fundação Bradesco, você encontra cursos gratuitos sobre informática, finanças, educação e habilidades comportamentais. Tudo online e com certificado gratuito para ajudar na sua formação.', 78)
         ,(1,'Cisco', 'https://www.netacad.com/pt/catalogs/learn', 'A Cisco disponibiliza cursos gratuitos com foco em tecnologia, como redes, programação, cibersegurança e IoT. São conteúdos atualizados e com certificado reconhecido internacionalmente. ', 40)
         ,(1,'E-aulas USP', 'https://eaulas.usp.br/portal/home.action', 'A plataforma da USP oferece videoaulas gratuitas de disciplinas universitárias em diversas áreas do conhecimento. É aberta ao público e perfeita para quem busca conteúdo confiável e de qualidade.', 300);

INSERT INTO categoria (descricao, data_insercao)
    VALUES ('Programação', '2025-05-14 21:00:00')
         ,('Banco de Dados', '2025-05-14 21:00:00')
         ,('Gestão e Negócios', '2025-05-14 21:00:00')
         ,('Línguas Estrangeiras', '2025-05-14 21:00:00')
         ,('Design e Ilustração', '2025-05-14 21:00:00')
         ,('Inteligência Artificial', '2025-05-14 21:00:00')
         ,('Saúde', '2025-05-14 21:00:00')
         ,('Marketing', '2025-05-14 21:00:00');

INSERT INTO area_categoria (categoria_id, data_insercao, situacao)
    VALUES (1,'2025-05-14 21:15:45', 0)
         ,(2,'2025-05-14 22:02:00', 0)
         ,(3,'2025-05-14 21:21:00', 0)
         ,(4,'2025-05-14 22:15:00', 0)
         ,(5,'2025-05-14 22:18:00', 0)
         ,(6,'2025-05-14 21:21:00', 0)
         ,(7,'2025-05-14 21:30:00', 0)
         ,(8,'2025-05-14 21:43:00', 0);

INSERT INTO curso (area_categoria_id, titulo_curso, url_curso, certificacao, quantidade_horas, descricao_curso, data_inicio, nivel_ensino, data_insercao)
    VALUES (1, 'Algoritmo', 'https://www.cursoemvideo.com/curso/curso-de-algoritmo/', 'Certificado digital pago', 40, 'O curso de Algoritmo do Curso em Vídeo ensina lógica de programação com VisualG. Ideal para iniciantes, aborda estruturas básicas de forma prática. O conteúdo é gratuito, com certificação opcional.', '2025-05-25 10:00:00', 'Iniciante', '2025-05-15 13:30:00')
         ,(5,'Introdução ao Design Digital', 'https://www.iped.com.br/cursos-gratis/programacao-e-desenvolvimento/curso-rapido/introducao-design-digital#conteudo', 'Certificado Digital', 5, 'Curso introdutório que aborda conceitos fundamentais de design digital, incluindo linguagens web, softwares de edição, organização de código e estruturação de páginas HTML. Ideal para iniciantes que desejam iniciar na criação de sites e interfaces digitais. Certificado digital gratuito.', '2025-05-25 10:00:00', 'Iniciante', '2025-05-15 13:00:00')
         ,(2, 'Modelagem de Dados', 'https://www.ev.org.br/cursos/modelagem-de-dados', 'Com certificado', 8, 'Curso introdutório que aborda conceitos essenciais de modelagem de dados, como bancos de dados, relacionamentos e integridade. Ideal para iniciantes que querem entender a estruturação e organização de dados em sistemas. Certificado digital incluso.', '2025-05-25 10:00:00', 'Iniciante', '2025-05-15 12:30:00')
         ,(1, 'Fundamentos de Python 2', 'https://www.netacad.com/pt/courses/python-essentials-2?courseLang=pt-BR', 'PCAP - Programador Associado Certificado com Phyton', 40, 'O curso Python Essentials 2 da Cisco aprofunda conceitos intermediários de Python, como manipulação de arquivos, funções avançadas e automação. Com exercícios práticos, o aluno desenvolve habilidades para criar scripts eficientes. Ao final, recebe certificado digital gratuito.', '2025-05-25 10:00:00','Intermediário', '2025-05-15 12:30:00')
         ,(1, 'Fundamentos do Python 1', 'https://www.netacad.com/pt/courses/python-essentials-1?courseLang=pt-BR', 'PCEP - Programador Python de nível básico certificado', 30, 'O curso Python Essentials 1 da Cisco oferece uma introdução prática à programação em Python para iniciantes, com exercícios interativos e conceitos básicos. Ao final, o aluno recebe certificado digital. Curso gratuito disponível na Cisco Networking Academy.', '2025-05-29 00:00:00', 'Iniciante', '2025-05-15 00:00:00');
        
INSERT INTO plataforma_curso (curso_id, plataforma_id, data_insercao, situacao)
    -- DATE no MySQL aceita o formato 'YYYY-MM-DD'
    VALUES (1, 1, '2025-05-15', 0); 

INSERT INTO mentor (nome_mentor, data_insercao, situacao)
    VALUES ('Gustavo Guanabara', '2025-05-15 00:00:00', 0);

INSERT INTO mentoria (curso_id, plataforma_id, mentor_id, data_insercao, situacao)
    VALUES (1, 1, 1, '2025-05-26 13:00:00', 0);

-- Comandos SELECT para conferência
SELECT * FROM usuario;
SELECT * FROM administrador;
SELECT * FROM plataforma;
SELECT * FROM categoria;
SELECT * FROM area_categoria;
SELECT * FROM curso;
SELECT * FROM plataforma_curso;
SELECT * FROM mentor;
SELECT * FROM mentoria;