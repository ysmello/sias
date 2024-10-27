CREATE DATABASE sias_db;

USE sias_db;

CREATE TABLE especialidade (
  esp_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  esp_nome VARCHAR(225) NULL,
  esp_descr VARCHAR(255) NULL,
  PRIMARY KEY(esp_id)
);

CREATE TABLE tp_prontuario (
  tp_pro_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  tp_pro_nome VARCHAR(20) NULL,
  tp_pro_descricao VARCHAR(255) NULL,
  tp_pro_situacao INTEGER UNSIGNED NULL,
  PRIMARY KEY(tp_pro_id)
);

CREATE TABLE pais (
  pais_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  pais_nome VARCHAR(200) NULL,
  PRIMARY KEY(pais_id)
);

CREATE TABLE tipo_logradouro (
  tp_log_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  tp_log_nome VARCHAR(255) NULL,
  PRIMARY KEY(tp_log_id)
);

CREATE TABLE cidadao (
  cid_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  cid_tipo INTEGER UNSIGNED NULL,
  cid_cpf_cnpj VARCHAR(14) NULL,
  cid_nome_razao VARCHAR(200) NULL,
  cid_nome_social_fantasia VARCHAR(200) NULL,
  cid_foto BLOB NULL,
  cid_dt_nascimento DATE NULL,
  cid_sexo INTEGER UNSIGNED NULL,
  cid_genero INTEGER UNSIGNED NULL,
  cid_email VARCHAR(200) NULL,
  cid_celular VARCHAR(14) NULL,
  cid_whatsapp INTEGER UNSIGNED NULL,
  PRIMARY KEY(cid_id)
);

CREATE TABLE usuario (
  usu_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  cidadao_cid_id INTEGER UNSIGNED NOT NULL,
  usu_tp INTEGER UNSIGNED NULL,
  usu_senha VARCHAR(255) NULL,
  usu_dt_cadastro DATE NULL,
  usu_dt_ultimo_acesso DATE NULL,
  usu_situacao INTEGER UNSIGNED NULL,
  PRIMARY KEY(usu_id),
  INDEX usuario_FKIndex1(cidadao_cid_id),
  FOREIGN KEY(cidadao_cid_id)
    REFERENCES cidadao(cid_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE convenios (
  conv_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  cidadao_cid_id INTEGER UNSIGNED NOT NULL,
  conv_num_ans VARCHAR(14) NULL,
  conv_situacao INTEGER UNSIGNED NULL,
  PRIMARY KEY(conv_id),
  INDEX convenios_FKIndex1(cidadao_cid_id),
  FOREIGN KEY(cidadao_cid_id)
    REFERENCES cidadao(cid_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE estado (
  est_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  pais_id INTEGER UNSIGNED NOT NULL,
  est_nome VARCHAR(200) NULL,
  PRIMARY KEY(est_id),
  INDEX estado_FKIndex1(pais_id),
  FOREIGN KEY(pais_id)
    REFERENCES pais(pais_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE profissional (
  prof_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_usu_id INTEGER UNSIGNED NOT NULL,
  prof_conselho VARCHAR(10) NULL,
  prof_plano_nome VARCHAR(255) NOT NULL,
  prof_especialidade VARCHAR(255) NOT NULL,
  
  PRIMARY KEY(prof_id),
  INDEX profissional_FKIndex1(usuario_usu_id),
  FOREIGN KEY(usuario_usu_id)
    REFERENCES usuario(usu_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE especialidade_has_profissional (
  especialidade_esp_id INTEGER UNSIGNED NOT NULL,
  profissional_prof_id INTEGER UNSIGNED NOT NULL,
  convenios_conv_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(especialidade_esp_id, profissional_prof_id),
  INDEX especialidade_has_profissional_FKIndex1(especialidade_esp_id),
  INDEX especialidade_has_profissional_FKIndex2(profissional_prof_id),
  INDEX especialidade_has_profissional_FKIndex3(convenios_conv_id),
  FOREIGN KEY(especialidade_esp_id)
    REFERENCES especialidade(esp_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(profissional_prof_id)
    REFERENCES profissional(prof_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(convenios_conv_id)
    REFERENCES convenios(conv_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE municipio (
  mun_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  estado_est_id INTEGER UNSIGNED NOT NULL,
  mun_nome VARCHAR(200) NULL,
  PRIMARY KEY(mun_id),
  INDEX municipio_FKIndex1(estado_est_id),
  FOREIGN KEY(estado_est_id)
    REFERENCES estado(est_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE paciente (
  pac_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_usu_id INTEGER UNSIGNED NOT NULL,
  pac_situacao INTEGER UNSIGNED NULL,
  PRIMARY KEY(pac_id),
  INDEX paciente_FKIndex1(usuario_usu_id),
  FOREIGN KEY(usuario_usu_id)
    REFERENCES usuario(usu_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE convenios_has_paciente (
  convenios_conv_id INTEGER UNSIGNED NOT NULL,
  paciente_pac_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(convenios_conv_id, paciente_pac_id),
  INDEX convenios_has_paciente_FKIndex1(convenios_conv_id),
  INDEX convenios_has_paciente_FKIndex2(paciente_pac_id),
  FOREIGN KEY(convenios_conv_id)
    REFERENCES convenios(conv_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(paciente_pac_id)
    REFERENCES paciente(pac_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE logradouro (
  log_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  tipo_logradouro_tp_log_id INTEGER UNSIGNED NOT NULL,
  municipio_mun_id INTEGER UNSIGNED NOT NULL,
  log_nome VARCHAR(100) NULL,
  log_numero VARCHAR(10) NULL,
  log_complemento VARCHAR(10) NULL,
  log_bairro VARCHAR(50) NULL,
  log_cep VARCHAR(8) NULL,
  PRIMARY KEY(log_id),
  INDEX endereco_FKIndex1(tipo_logradouro_tp_log_id),
  INDEX endereco_FKIndex2(municipio_mun_id),
  FOREIGN KEY(tipo_logradouro_tp_log_id)
    REFERENCES tipo_logradouro(tp_log_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(municipio_mun_id)
    REFERENCES municipio(mun_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE agenda (
  age_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  convenios_has_paciente_paciente_pac_id INTEGER UNSIGNED NOT NULL,
  convenios_has_paciente_convenios_conv_id INTEGER UNSIGNED NOT NULL,
  especialidade_has_profissional_profissional_prof_id INTEGER UNSIGNED NOT NULL,
  especialidade_has_profissional_especialidade_esp_id INTEGER UNSIGNED NOT NULL,
  age_data DATETIME NULL,
  PRIMARY KEY(age_id),
  INDEX agenda_FKIndex1(especialidade_has_profissional_especialidade_esp_id, especialidade_has_profissional_profissional_prof_id),
  INDEX agenda_FKIndex2(convenios_has_paciente_convenios_conv_id, convenios_has_paciente_paciente_pac_id),
  FOREIGN KEY(especialidade_has_profissional_especialidade_esp_id, especialidade_has_profissional_profissional_prof_id)
    REFERENCES especialidade_has_profissional(especialidade_esp_id, profissional_prof_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(convenios_has_paciente_convenios_conv_id, convenios_has_paciente_paciente_pac_id)
    REFERENCES convenios_has_paciente(convenios_conv_id, paciente_pac_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE logradouro_has_cidadao (
  log_cid_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  logradouro_log_id INTEGER UNSIGNED NOT NULL,
  cidadao_cid_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(log_cid_id, logradouro_log_id, cidadao_cid_id),
  INDEX logradouro_has_cidadao_FKIndex1(logradouro_log_id),
  INDEX logradouro_has_cidadao_FKIndex2(cidadao_cid_id),
  FOREIGN KEY(logradouro_log_id)
    REFERENCES logradouro(log_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(cidadao_cid_id)
    REFERENCES cidadao(cid_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE avaliacao (
  ava_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  agenda_age_id INTEGER UNSIGNED NOT NULL,
  ava_nota INTEGER UNSIGNED NULL,
  ava_data DATETIME NULL,
  PRIMARY KEY(ava_id),
  INDEX avaliacao_FKIndex1(agenda_age_id),
  FOREIGN KEY(agenda_age_id)
    REFERENCES agenda(age_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE prontuario (
  pro_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  agenda_age_id INTEGER UNSIGNED NOT NULL,
  tp_prontuario_tp_pro_id INTEGER UNSIGNED NOT NULL,
  pro_descricao VARCHAR(255) NULL,
  PRIMARY KEY(pro_id),
  INDEX prontuario_FKIndex1(tp_prontuario_tp_pro_id),
  INDEX prontuario_FKIndex2(agenda_age_id),
  FOREIGN KEY(tp_prontuario_tp_pro_id)
    REFERENCES tp_prontuario(tp_pro_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(agenda_age_id)
    REFERENCES agenda(age_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE hist_prontuario (
  pro_hist_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  prontuario_pro_id INTEGER UNSIGNED NOT NULL,
  pro_hist_date DATETIME NULL,
  pro_hist_descr_anterior VARCHAR(255) NULL,
  pro_hist_descr_atual VARCHAR(255) NULL,
  pro_hist_tp_pro_anterior INTEGER UNSIGNED NULL,
  pro_hist_tp_pro_atual INTEGER UNSIGNED NULL,
  PRIMARY KEY(pro_hist_id),
  INDEX hist_prontuario_FKIndex1(prontuario_pro_id),
  FOREIGN KEY(prontuario_pro_id)
    REFERENCES prontuario(pro_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE planos (
  plano_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  plano_nome VARCHAR(225) NULL,
  plano_descr VARCHAR(255) NULL,
  PRIMARY KEY(plano_id)
);
