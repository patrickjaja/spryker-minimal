<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1546780713.
 * Generated on 2019-01-06 13:18:33 by root
 */
class PropelMigration_1546780713
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'zed' => '
BEGIN;

CREATE SEQUENCE "spy_acl_role_pk_seq";

CREATE TABLE "spy_acl_role"
(
    "id_acl_role" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_role"),
    CONSTRAINT "spy_acl_role-name" UNIQUE ("name")
);

CREATE SEQUENCE "spy_acl_rule_pk_seq";

CREATE TABLE "spy_acl_rule"
(
    "id_acl_rule" INTEGER NOT NULL,
    "fk_acl_role" INTEGER NOT NULL,
    "bundle" VARCHAR(45) NOT NULL,
    "controller" VARCHAR(45) NOT NULL,
    "action" VARCHAR(45) NOT NULL,
    "type" INT2 NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_rule")
);

CREATE SEQUENCE "spy_acl_group_pk_seq";

CREATE TABLE "spy_acl_group"
(
    "id_acl_group" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_group"),
    CONSTRAINT "spy_acl_group-name" UNIQUE ("name")
);

CREATE TABLE "spy_acl_user_has_group"
(
    "fk_user" INTEGER NOT NULL,
    "fk_acl_group" INTEGER NOT NULL,
    PRIMARY KEY ("fk_user","fk_acl_group")
);

CREATE TABLE "spy_acl_groups_has_roles"
(
    "fk_acl_role" INTEGER NOT NULL,
    "fk_acl_group" INTEGER NOT NULL,
    PRIMARY KEY ("fk_acl_role","fk_acl_group")
);

CREATE SEQUENCE "spy_auth_reset_password_pk_seq";

CREATE TABLE "spy_auth_reset_password"
(
    "id_auth_reset_password" INTEGER NOT NULL,
    "fk_user" INTEGER NOT NULL,
    "code" VARCHAR(35) NOT NULL,
    "status" INT2 NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_auth_reset_password","fk_user"),
    CONSTRAINT "spy_auth_reset_password-code" UNIQUE ("code")
);

CREATE SEQUENCE "spy_category_pk_seq";

CREATE TABLE "spy_category"
(
    "id_category" INTEGER NOT NULL,
    "category_key" VARCHAR(255) NOT NULL,
    "is_active" BOOLEAN DEFAULT \'t\',
    "is_in_menu" BOOLEAN DEFAULT \'t\',
    "is_clickable" BOOLEAN DEFAULT \'t\',
    "is_searchable" BOOLEAN DEFAULT \'t\',
    "fk_category_template" INTEGER,
    PRIMARY KEY ("id_category"),
    CONSTRAINT "spy_category-category_key" UNIQUE ("category_key")
);

CREATE SEQUENCE "spy_category_attribute_pk_seq";

CREATE TABLE "spy_category_attribute"
(
    "id_category_attribute" INTEGER NOT NULL,
    "fk_category" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "meta_title" TEXT,
    "meta_description" TEXT,
    "meta_keywords" TEXT,
    "category_image_name" VARCHAR(255),
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_category_attribute")
);

CREATE SEQUENCE "spy_category_node_pk_seq";

CREATE TABLE "spy_category_node"
(
    "id_category_node" INTEGER NOT NULL,
    "fk_category" INTEGER NOT NULL,
    "fk_parent_category_node" INTEGER,
    "is_root" BOOLEAN DEFAULT \'f\',
    "is_main" BOOLEAN DEFAULT \'f\',
    "node_order" INTEGER DEFAULT 0,
    PRIMARY KEY ("id_category_node")
);

CREATE INDEX "spy_category_node_i_8f153e" ON "spy_category_node" ("node_order");

CREATE SEQUENCE "spy_category_closure_table_pk_seq";

CREATE TABLE "spy_category_closure_table"
(
    "id_category_closure_table" INTEGER NOT NULL,
    "fk_category_node" INTEGER NOT NULL,
    "fk_category_node_descendant" INTEGER NOT NULL,
    "depth" INTEGER NOT NULL,
    PRIMARY KEY ("id_category_closure_table")
);

CREATE SEQUENCE "spy_category_node_page_search_pk_seq";

CREATE TABLE "spy_category_node_page_search"
(
    "id_category_node_page_search" INT8 NOT NULL,
    "fk_category_node" INTEGER NOT NULL,
    "structured_data" TEXT NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_category_node_page_search"),
    CONSTRAINT "spy_category_node_page_search-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_category_node_page_search-fk_category_node" ON "spy_category_node_page_search" ("fk_category_node");

CREATE SEQUENCE "spy_category_tree_storage_pk_seq";

CREATE TABLE "spy_category_tree_storage"
(
    "id_category_tree_storage" INT8 NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_category_tree_storage"),
    CONSTRAINT "spy_category_tree_storage-unique-key" UNIQUE ("key")
);

CREATE SEQUENCE "spy_category_node_storage_pk_seq";

CREATE TABLE "spy_category_node_storage"
(
    "id_category_node_storage" INT8 NOT NULL,
    "fk_category_node" INTEGER NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_category_node_storage"),
    CONSTRAINT "spy_category_node_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_category_node_storage-fk_category_node" ON "spy_category_node_storage" ("fk_category_node");

CREATE SEQUENCE "spy_category_template_pk_seq";

CREATE TABLE "spy_category_template"
(
    "id_category_template" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "template_path" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_category_template"),
    CONSTRAINT "spy_category_template-template_path" UNIQUE ("template_path")
);

CREATE SEQUENCE "spy_cms_version_pk_seq";

CREATE TABLE "spy_cms_version"
(
    "id_cms_version" INTEGER NOT NULL,
    "fk_cms_page" INTEGER NOT NULL,
    "fk_user" INTEGER,
    "data" TEXT,
    "version" INTEGER NOT NULL,
    "version_name" VARCHAR(255),
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_version")
);

CREATE INDEX "spy_cms_version-index-fk_cms_page_version" ON "spy_cms_version" ("fk_cms_page","version");

CREATE SEQUENCE "spy_cms_template_pk_seq";

CREATE TABLE "spy_cms_template"
(
    "id_cms_template" INTEGER NOT NULL,
    "template_name" VARCHAR(255) NOT NULL,
    "template_path" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_cms_template"),
    CONSTRAINT "spy_cms_template-unique-template_path" UNIQUE ("template_path")
);

CREATE INDEX "spy_cms_template-template_path" ON "spy_cms_template" ("template_path");

CREATE SEQUENCE "spy_cms_page_pk_seq";

CREATE TABLE "spy_cms_page"
(
    "id_cms_page" INTEGER NOT NULL,
    "fk_template" INTEGER NOT NULL,
    "is_active" BOOLEAN DEFAULT \'f\' NOT NULL,
    "is_searchable" BOOLEAN DEFAULT \'f\' NOT NULL,
    "page_key" VARCHAR(32),
    "valid_from" TIMESTAMP,
    "valid_to" TIMESTAMP,
    PRIMARY KEY ("id_cms_page")
);

CREATE INDEX "spy_cms_page_i_615cb5" ON "spy_cms_page" ("page_key");

CREATE SEQUENCE "spy_cms_page_localized_attributes_pk_seq";

CREATE TABLE "spy_cms_page_localized_attributes"
(
    "id_cms_page_localized_attributes" INTEGER NOT NULL,
    "fk_cms_page" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "meta_description" TEXT,
    "meta_keywords" TEXT,
    "meta_title" VARCHAR(255),
    "name" VARCHAR NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_page_localized_attributes"),
    CONSTRAINT "spy_cms_page_localized_attributes-unique-fk_cms_page" UNIQUE ("fk_cms_page","fk_locale")
);

CREATE SEQUENCE "spy_cms_glossary_key_mapping_pk_seq";

CREATE TABLE "spy_cms_glossary_key_mapping"
(
    "id_cms_glossary_key_mapping" INTEGER NOT NULL,
    "fk_glossary_key" INTEGER NOT NULL,
    "fk_page" INTEGER NOT NULL,
    "placeholder" VARCHAR NOT NULL,
    PRIMARY KEY ("id_cms_glossary_key_mapping"),
    CONSTRAINT "spy_cms_glossary_key_mapping-unique-fk_page" UNIQUE ("fk_page","placeholder")
);

CREATE INDEX "spy_cms_glossary_key_mapping-fk_page" ON "spy_cms_glossary_key_mapping" ("fk_page","placeholder");

CREATE SEQUENCE "spy_cms_block_template_pk_seq";

CREATE TABLE "spy_cms_block_template"
(
    "id_cms_block_template" INTEGER NOT NULL,
    "template_name" VARCHAR(255) NOT NULL,
    "template_path" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_cms_block_template"),
    CONSTRAINT "spy_cms_block_template-unique-template_path" UNIQUE ("template_path")
);

CREATE SEQUENCE "spy_cms_block_glossary_key_mapping_pk_seq";

CREATE TABLE "spy_cms_block_glossary_key_mapping"
(
    "id_cms_block_glossary_key_mapping" INTEGER NOT NULL,
    "fk_cms_block" INTEGER NOT NULL,
    "fk_glossary_key" INTEGER NOT NULL,
    "placeholder" VARCHAR NOT NULL,
    PRIMARY KEY ("id_cms_block_glossary_key_mapping"),
    CONSTRAINT "spy_cms_block_glossary_key_mapping-unique-fk_cms_block" UNIQUE ("fk_cms_block","placeholder")
);

CREATE SEQUENCE "spy_cms_block_pk_seq";

CREATE TABLE "spy_cms_block"
(
    "id_cms_block" INTEGER NOT NULL,
    "fk_page" INTEGER,
    "fk_template" INTEGER,
    "is_active" BOOLEAN DEFAULT \'f\' NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "type" VARCHAR(255),
    "valid_from" TIMESTAMP,
    "valid_to" TIMESTAMP,
    "value" INTEGER,
    PRIMARY KEY ("id_cms_block"),
    CONSTRAINT "spy_cms_block-name-uq" UNIQUE ("name")
);

COMMENT ON COLUMN "spy_cms_block"."fk_page" IS \'Deprecated\';

COMMENT ON COLUMN "spy_cms_block"."type" IS \'Deprecated\';

COMMENT ON COLUMN "spy_cms_block"."value" IS \'Deprecated\';

CREATE SEQUENCE "id_cms_block_store_pk_seq";

CREATE TABLE "spy_cms_block_store"
(
    "id_cms_block_store" INTEGER NOT NULL,
    "fk_cms_block" INTEGER NOT NULL,
    "fk_store" INTEGER NOT NULL,
    PRIMARY KEY ("id_cms_block_store"),
    CONSTRAINT "spy_cms_block_store-fk_cms_block-fk_store" UNIQUE ("fk_cms_block","fk_store")
);

CREATE SEQUENCE "spy_cms_block_category_connector_pk_seq";

CREATE TABLE "spy_cms_block_category_connector"
(
    "id_cms_block_category_connector" INTEGER NOT NULL,
    "fk_category" INTEGER NOT NULL,
    "fk_category_template" INTEGER NOT NULL,
    "fk_cms_block" INTEGER NOT NULL,
    "fk_cms_block_category_position" INTEGER,
    PRIMARY KEY ("id_cms_block_category_connector")
);

CREATE INDEX "spy_cms_block_category-connector-fk_cms_block" ON "spy_cms_block_category_connector" ("fk_cms_block");

CREATE INDEX "spy_cms_block_category-connector-fk_category" ON "spy_cms_block_category_connector" ("fk_category");

CREATE SEQUENCE "spy_cms_block_category_position_pk_seq";

CREATE TABLE "spy_cms_block_category_position"
(
    "id_cms_block_category_position" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_cms_block_category_position")
);

CREATE SEQUENCE "spy_cms_block_category_storage_pk_seq";

CREATE TABLE "spy_cms_block_category_storage"
(
    "id_cms_block_category_storage" INT8 NOT NULL,
    "fk_category" INTEGER NOT NULL,
    "data" TEXT,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_block_category_storage"),
    CONSTRAINT "spy_cms_block_category_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_cms_block_category_storage-fk_category" ON "spy_cms_block_category_storage" ("fk_category");

CREATE SEQUENCE "spy_cms_block_storage_pk_seq";

CREATE TABLE "spy_cms_block_storage"
(
    "id_cms_block_storage" INT8 NOT NULL,
    "fk_cms_block" INTEGER NOT NULL,
    "name" VARCHAR NOT NULL,
    "data" TEXT,
    "store" VARCHAR(128),
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_block_storage"),
    CONSTRAINT "spy_cms_block_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_cms_block_storage-fk_cms_block" ON "spy_cms_block_storage" ("fk_cms_block");

CREATE SEQUENCE "spy_cms_page_search_pk_seq";

CREATE TABLE "spy_cms_page_search"
(
    "id_cms_page_search" INT8 NOT NULL,
    "fk_cms_page" INTEGER NOT NULL,
    "structured_data" TEXT NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_page_search"),
    CONSTRAINT "spy_cms_page_search-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_cms_page_search-fk_cms_page" ON "spy_cms_page_search" ("fk_cms_page");

CREATE SEQUENCE "spy_cms_page_storage_pk_seq";

CREATE TABLE "spy_cms_page_storage"
(
    "id_cms_page_storage" INT8 NOT NULL,
    "fk_cms_page" INTEGER NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_cms_page_storage"),
    CONSTRAINT "spy_cms_page_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_cms_page_storage-fk_cms_page" ON "spy_cms_page_storage" ("fk_cms_page");

CREATE SEQUENCE "spy_country_pk_seq";

CREATE TABLE "spy_country"
(
    "id_country" INTEGER NOT NULL,
    "iso2_code" VARCHAR(2) NOT NULL,
    "iso3_code" VARCHAR(3),
    "name" VARCHAR(255),
    "postal_code_mandatory" BOOLEAN DEFAULT \'f\',
    "postal_code_regex" VARCHAR(500),
    PRIMARY KEY ("id_country"),
    CONSTRAINT "spy_country-iso2_code" UNIQUE ("iso2_code"),
    CONSTRAINT "spy_country-iso3_code" UNIQUE ("iso3_code")
);

CREATE SEQUENCE "spy_region_pk_seq";

CREATE TABLE "spy_region"
(
    "id_region" INTEGER NOT NULL,
    "fk_country" INTEGER,
    "name" VARCHAR(100) NOT NULL,
    "iso2_code" VARCHAR(6) NOT NULL,
    PRIMARY KEY ("id_region"),
    CONSTRAINT "spy_region-iso2_code" UNIQUE ("iso2_code")
);

CREATE SEQUENCE "spy_currency_pk_seq";

CREATE TABLE "spy_currency"
(
    "id_currency" INTEGER NOT NULL,
    "name" VARCHAR(255),
    "code" VARCHAR(5),
    "symbol" VARCHAR(255),
    PRIMARY KEY ("id_currency")
);

CREATE SEQUENCE "spy_customer_pk_seq";

CREATE TABLE "spy_customer"
(
    "id_customer" INTEGER NOT NULL,
    "fk_locale" INTEGER,
    "fk_user" INTEGER,
    "anonymized_at" TIMESTAMP,
    "company" VARCHAR(100),
    "customer_reference" VARCHAR(255) NOT NULL,
    "date_of_birth" DATE,
    "default_billing_address" INTEGER,
    "default_shipping_address" INTEGER,
    "email" VARCHAR(255) NOT NULL,
    "first_name" VARCHAR(100),
    "gender" INT2,
    "last_name" VARCHAR(100),
    "password" VARCHAR(255),
    "phone" VARCHAR(255),
    "registered" DATE,
    "registration_key" VARCHAR(150),
    "restore_password_date" TIMESTAMP,
    "restore_password_key" VARCHAR(150),
    "salutation" INT2,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_customer"),
    CONSTRAINT "spy_customer-email" UNIQUE ("email"),
    CONSTRAINT "spy_customer-customer_reference" UNIQUE ("customer_reference")
);

CREATE SEQUENCE "spy_customer_address_pk_seq";

CREATE TABLE "spy_customer_address"
(
    "id_customer_address" INTEGER NOT NULL,
    "fk_country" INTEGER NOT NULL,
    "fk_customer" INTEGER NOT NULL,
    "fk_region" INTEGER,
    "address1" VARCHAR(255),
    "address2" VARCHAR(255),
    "address3" VARCHAR(255),
    "anonymized_at" TIMESTAMP,
    "city" VARCHAR(255),
    "comment" VARCHAR(255),
    "company" VARCHAR(255),
    "deleted_at" TIMESTAMP,
    "first_name" VARCHAR(100) NOT NULL,
    "last_name" VARCHAR(100) NOT NULL,
    "phone" VARCHAR(255),
    "salutation" INT2,
    "uuid" VARCHAR(255),
    "zip_code" VARCHAR(15),
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_customer_address"),
    CONSTRAINT "spy_customer_address-unique-uuid" UNIQUE ("uuid")
);

CREATE INDEX "spy_customer_address-fk_customer" ON "spy_customer_address" ("fk_customer");

CREATE SEQUENCE "spy_customer_group_pk_seq";

CREATE TABLE "spy_customer_group"
(
    "id_customer_group" INTEGER NOT NULL,
    "name" VARCHAR(70) NOT NULL,
    "description" VARCHAR(255),
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_customer_group"),
    CONSTRAINT "spy_customer-name" UNIQUE ("name")
);

CREATE SEQUENCE "spy_customer_group_to_customer_pk_seq";

CREATE TABLE "spy_customer_group_to_customer"
(
    "id_customer_group_to_customer" INTEGER NOT NULL,
    "fk_customer_group" INTEGER NOT NULL,
    "fk_customer" INTEGER NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_customer_group_to_customer"),
    CONSTRAINT "fk_customer_group-fk_customer" UNIQUE ("fk_customer_group","fk_customer")
);

CREATE SEQUENCE "spy_customer_note_pk_seq";

CREATE TABLE "spy_customer_note"
(
    "id_customer_note" INTEGER NOT NULL,
    "fk_customer" INTEGER NOT NULL,
    "fk_user" INTEGER NOT NULL,
    "username" VARCHAR,
    "message" TEXT NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_customer_note")
);

CREATE SEQUENCE "spy_event_behavior_entity_change_pk_seq";

CREATE TABLE "spy_event_behavior_entity_change"
(
    "id_event_behavior_entity_change" INT8 NOT NULL,
    "data" TEXT,
    "process_id" VARCHAR,
    "created_at" TIMESTAMP,
    PRIMARY KEY ("id_event_behavior_entity_change")
);

CREATE SEQUENCE "spy_glossary_key_pk_seq";

CREATE TABLE "spy_glossary_key"
(
    "id_glossary_key" INTEGER NOT NULL,
    "is_active" BOOLEAN DEFAULT \'t\' NOT NULL,
    "key" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_glossary_key"),
    CONSTRAINT "spy_glossary_key-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_glossary_key-index-key" ON "spy_glossary_key" ("key");

CREATE INDEX "spy_glossary_key-is_active" ON "spy_glossary_key" ("is_active");

CREATE SEQUENCE "spy_glossary_translation_pk_seq";

CREATE TABLE "spy_glossary_translation"
(
    "id_glossary_translation" INTEGER NOT NULL,
    "fk_glossary_key" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "is_active" BOOLEAN DEFAULT \'t\' NOT NULL,
    "value" TEXT NOT NULL,
    PRIMARY KEY ("id_glossary_translation"),
    CONSTRAINT "spy_glossary_translation-unique-fk_glossary_key" UNIQUE ("fk_glossary_key","fk_locale")
);

CREATE INDEX "spy_glossary_translation-index-fk_locale" ON "spy_glossary_translation" ("fk_locale");

CREATE INDEX "spy_glossary_translation-is_active" ON "spy_glossary_translation" ("is_active");

CREATE SEQUENCE "spy_glossary_storage_pk_seq";

CREATE TABLE "spy_glossary_storage"
(
    "id_glossary_storage" INT8 NOT NULL,
    "fk_glossary_key" INTEGER NOT NULL,
    "glossary_key" VARCHAR NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_glossary_storage"),
    CONSTRAINT "spy_glossary_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_glossary_storage-fk_glossary_key" ON "spy_glossary_storage" ("fk_glossary_key");

CREATE SEQUENCE "spy_locale_pk_seq";

CREATE TABLE "spy_locale"
(
    "id_locale" INTEGER NOT NULL,
    "locale_name" VARCHAR(5) NOT NULL,
    "is_active" BOOLEAN DEFAULT \'t\' NOT NULL,
    PRIMARY KEY ("id_locale"),
    CONSTRAINT "spy_locale-unique-locale_name" UNIQUE ("locale_name")
);

CREATE INDEX "spy_locale-index-locale_name" ON "spy_locale" ("locale_name");

CREATE SEQUENCE "spy_navigation_pk_seq";

CREATE TABLE "spy_navigation"
(
    "id_navigation" INTEGER NOT NULL,
    "is_active" BOOLEAN DEFAULT \'t\' NOT NULL,
    "key" VARCHAR(255) NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_navigation"),
    CONSTRAINT "spy_navigation_key-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_navigation-index-key" ON "spy_navigation" ("key");

CREATE INDEX "spy_navigation-index-is_active" ON "spy_navigation" ("is_active");

CREATE SEQUENCE "spy_navigation_node_pk_seq";

CREATE TABLE "spy_navigation_node"
(
    "id_navigation_node" INTEGER NOT NULL,
    "fk_navigation" INTEGER NOT NULL,
    "fk_parent_navigation_node" INTEGER,
    "is_active" BOOLEAN DEFAULT \'t\' NOT NULL,
    "node_key" VARCHAR(32),
    "node_type" VARCHAR(255),
    "position" INTEGER,
    "valid_from" TIMESTAMP,
    "valid_to" TIMESTAMP,
    PRIMARY KEY ("id_navigation_node")
);

CREATE INDEX "spy_navigation_node_i_ba7161" ON "spy_navigation_node" ("position");

CREATE INDEX "spy_navigation_node_i_576b1b" ON "spy_navigation_node" ("node_key");

CREATE SEQUENCE "spy_navigation_node_localized_attributes_pk_seq";

CREATE TABLE "spy_navigation_node_localized_attributes"
(
    "id_navigation_node_localized_attributes" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "fk_navigation_node" INTEGER NOT NULL,
    "fk_url" INTEGER,
    "css_class" VARCHAR(255),
    "external_url" VARCHAR(255),
    "link" VARCHAR(255),
    "title" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_navigation_node_localized_attributes")
);

CREATE SEQUENCE "spy_navigation_storage_pk_seq";

CREATE TABLE "spy_navigation_storage"
(
    "id_navigation_storage" INT8 NOT NULL,
    "fk_navigation" INTEGER NOT NULL,
    "navigation_key" VARCHAR NOT NULL,
    "data" TEXT,
    "locale" VARCHAR(16) NOT NULL,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_navigation_storage"),
    CONSTRAINT "spy_navigation_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_navigation_storage-fk_navigation" ON "spy_navigation_storage" ("fk_navigation");

CREATE SEQUENCE "spy_oauth_access_token_pk_seq";

CREATE TABLE "spy_oauth_access_token"
(
    "id_oauth_access_token" INTEGER NOT NULL,
    "identifier" VARCHAR(3024) NOT NULL,
    "scopes" VARCHAR(1024),
    "user_identifier" VARCHAR(1024) NOT NULL,
    "fk_oauth_client" VARCHAR(1024) NOT NULL,
    "expirity_date" TIMESTAMP NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_oauth_access_token")
);

CREATE SEQUENCE "spy_oauth_client_pk_seq";

CREATE TABLE "spy_oauth_client"
(
    "id_oauth_client" INTEGER NOT NULL,
    "identifier" VARCHAR(1024) NOT NULL,
    "name" VARCHAR(1024) NOT NULL,
    "redirect_uri" VARCHAR(1024),
    "secret" VARCHAR(1024),
    "is_confidential" BOOLEAN,
    PRIMARY KEY ("id_oauth_client"),
    CONSTRAINT "spy_oauth_client-identifier" UNIQUE ("identifier")
);

CREATE SEQUENCE "spy_oauth_scope_pk_seq";

CREATE TABLE "spy_oauth_scope"
(
    "id_oauth_scope" INTEGER NOT NULL,
    "identifier" VARCHAR(1024) NOT NULL,
    "description" TEXT,
    PRIMARY KEY ("id_oauth_scope"),
    CONSTRAINT "spy_oauth_scope-identifier" UNIQUE ("identifier")
);

CREATE SEQUENCE "spy_permission_pk_seq";

CREATE TABLE "spy_permission"
(
    "id_permission" INTEGER NOT NULL,
    "key" VARCHAR(255) NOT NULL,
    "configuration_signature" TEXT,
    PRIMARY KEY ("id_permission"),
    CONSTRAINT "spy_permission-key" UNIQUE ("key")
);

CREATE TABLE "spy_propel_heartbeat"
(
    "heartbeat_check" VARCHAR NOT NULL,
    PRIMARY KEY ("heartbeat_check")
);

CREATE SEQUENCE "spy_queue_process_pk_seq";

CREATE TABLE "spy_queue_process"
(
    "id_queue_process" INTEGER NOT NULL,
    "server_id" VARCHAR(255) NOT NULL,
    "process_pid" INTEGER NOT NULL,
    "worker_pid" INTEGER NOT NULL,
    "queue_name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_queue_process"),
    CONSTRAINT "spy_queue_process-unique-key" UNIQUE ("server_id","process_pid","queue_name")
);

CREATE INDEX "spy_queue_process-index-key" ON "spy_queue_process" ("server_id","queue_name");

CREATE TABLE "spy_sales_order"
(
    "customer_reference" VARCHAR(255)
);

CREATE INDEX "spy_sales_order-customer_reference" ON "spy_sales_order" ("customer_reference");

CREATE SEQUENCE "spy_sequence_number_pk_seq";

CREATE TABLE "spy_sequence_number"
(
    "id_sequence_number" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "current_id" INTEGER NOT NULL,
    PRIMARY KEY ("id_sequence_number"),
    CONSTRAINT "spy_sequence_number-name" UNIQUE ("name")
);

CREATE SEQUENCE "spy_store_pk_seq";

CREATE TABLE "spy_store"
(
    "id_store" INTEGER NOT NULL,
    "name" VARCHAR(255),
    PRIMARY KEY ("id_store")
);

CREATE SEQUENCE "spy_touch_pk_seq";

CREATE TABLE "spy_touch"
(
    "id_touch" INTEGER NOT NULL,
    "item_type" VARCHAR(255) NOT NULL,
    "item_event" INT2 NOT NULL,
    "item_id" INTEGER NOT NULL,
    "touched" TIMESTAMP NOT NULL,
    PRIMARY KEY ("id_touch"),
    CONSTRAINT "spy_touch-unique-item_id" UNIQUE ("item_id","item_event","item_type")
);

CREATE INDEX "spy_touch-index-item_id" ON "spy_touch" ("item_id");

CREATE INDEX "index_spy_touch-item_event_item_type_touched" ON "spy_touch" ("item_event","item_type","touched");

CREATE SEQUENCE "spy_touch_storage_pk_seq";

CREATE TABLE "spy_touch_storage"
(
    "id_touch_storage" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "fk_store" INTEGER,
    "fk_touch" INTEGER NOT NULL,
    "key" VARCHAR NOT NULL,
    PRIMARY KEY ("id_touch_storage"),
    CONSTRAINT "spy_touch_storage-unique-fk_locale" UNIQUE ("fk_locale","key")
);

CREATE INDEX "spy_touch_storage-index-key" ON "spy_touch_storage" ("key");

CREATE SEQUENCE "spy_touch_search_pk_seq";

CREATE TABLE "spy_touch_search"
(
    "id_touch_search" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "fk_store" INTEGER,
    "fk_touch" INTEGER NOT NULL,
    "key" VARCHAR NOT NULL,
    PRIMARY KEY ("id_touch_search"),
    CONSTRAINT "spy_touch_search-unique-fk_locale" UNIQUE ("fk_locale","key")
);

CREATE INDEX "spy_touch_search-index-key" ON "spy_touch_search" ("key");

CREATE SEQUENCE "spy_unauthenticated_customer_access_pk_seq";

CREATE TABLE "spy_unauthenticated_customer_access"
(
    "id_unauthenticated_customer_access" INTEGER NOT NULL,
    "content_type" VARCHAR(100) NOT NULL,
    "is_restricted" BOOLEAN NOT NULL,
    PRIMARY KEY ("id_unauthenticated_customer_access"),
    CONSTRAINT "spy_unauthenticated_customer_access_u_0984b8" UNIQUE ("content_type")
);

CREATE SEQUENCE "unauthenticated_customer_access_storage_pk_seq";

CREATE TABLE "spy_unauthenticated_customer_access_storage"
(
    "id_unauthenticated_customer_access_storage" INTEGER NOT NULL,
    "data" TEXT,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_unauthenticated_customer_access_storage"),
    CONSTRAINT "spy_unauthenticated_customer_access_storage-unique-key" UNIQUE ("key")
);

CREATE SEQUENCE "spy_url_pk_seq";

CREATE TABLE "spy_url"
(
    "id_url" INTEGER NOT NULL,
    "fk_locale" INTEGER NOT NULL,
    "fk_resource_categorynode" INTEGER,
    "fk_resource_page" INTEGER,
    "fk_resource_redirect" INTEGER,
    "url" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_url"),
    CONSTRAINT "spy_url_unique_key" UNIQUE ("url")
);

CREATE SEQUENCE "spy_url_redirect_pk_seq";

CREATE TABLE "spy_url_redirect"
(
    "id_url_redirect" INTEGER NOT NULL,
    "status" INTEGER DEFAULT 301 NOT NULL,
    "to_url" VARCHAR(255) NOT NULL,
    PRIMARY KEY ("id_url_redirect")
);

CREATE INDEX "spy_url_redirect-to_url" ON "spy_url_redirect" ("to_url","status");

CREATE SEQUENCE "spy_url_storage_pk_seq";

CREATE TABLE "spy_url_storage"
(
    "id_url_storage" INT8 NOT NULL,
    "fk_categorynode" INTEGER,
    "fk_page" INTEGER,
    "fk_product_abstract" INTEGER,
    "fk_product_set" INTEGER,
    "fk_redirect" INTEGER,
    "fk_url" INTEGER NOT NULL,
    "url" VARCHAR NOT NULL,
    "data" TEXT,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_url_storage"),
    CONSTRAINT "spy_url_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_url_storage-fk_url" ON "spy_url_storage" ("fk_url");

CREATE SEQUENCE "spy_url_redirect_storage_pk_seq";

CREATE TABLE "spy_url_redirect_storage"
(
    "id_url_redirect_storage" INT8 NOT NULL,
    "fk_url_redirect" INTEGER NOT NULL,
    "data" TEXT,
    "key" VARCHAR,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_url_redirect_storage"),
    CONSTRAINT "spy_url_redirect_storage-unique-key" UNIQUE ("key")
);

CREATE INDEX "spy_url_redirect_storage-fk_url_redirect" ON "spy_url_redirect_storage" ("fk_url_redirect");

CREATE SEQUENCE "spy_user_pk_seq";

CREATE TABLE "spy_user"
(
    "id_user" INTEGER NOT NULL,
    "first_name" VARCHAR(45) NOT NULL,
    "is_agent" BOOLEAN,
    "last_login" TIMESTAMP,
    "last_name" VARCHAR(255) NOT NULL,
    "password" VARCHAR(255) NOT NULL,
    "status" INT2 DEFAULT 0 NOT NULL,
    "username" VARCHAR(45) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id_user"),
    CONSTRAINT "spy_user-username" UNIQUE ("username")
);

CREATE TABLE "spy_acl_role_archive"
(
    "id_acl_role" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "archived_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_role")
);

CREATE INDEX "spy_acl_role_archive_i_d94269" ON "spy_acl_role_archive" ("name");

CREATE TABLE "spy_acl_rule_archive"
(
    "id_acl_rule" INTEGER NOT NULL,
    "fk_acl_role" INTEGER NOT NULL,
    "bundle" VARCHAR(45) NOT NULL,
    "controller" VARCHAR(45) NOT NULL,
    "action" VARCHAR(45) NOT NULL,
    "type" INT2 NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "archived_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_rule")
);

CREATE TABLE "spy_acl_group_archive"
(
    "id_acl_group" INTEGER NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "archived_at" TIMESTAMP,
    PRIMARY KEY ("id_acl_group")
);

CREATE INDEX "spy_acl_group_archive_i_d94269" ON "spy_acl_group_archive" ("name");

CREATE TABLE "spy_auth_reset_password_archive"
(
    "id_auth_reset_password" INTEGER NOT NULL,
    "fk_user" INTEGER NOT NULL,
    "code" VARCHAR(35) NOT NULL,
    "status" INT2 NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "archived_at" TIMESTAMP,
    PRIMARY KEY ("id_auth_reset_password","fk_user")
);

CREATE INDEX "spy_auth_reset_password_archive_i_4db226" ON "spy_auth_reset_password_archive" ("code");

CREATE TABLE "spy_user_archive"
(
    "id_user" INTEGER NOT NULL,
    "first_name" VARCHAR(45) NOT NULL,
    "is_agent" BOOLEAN,
    "last_login" TIMESTAMP,
    "last_name" VARCHAR(255) NOT NULL,
    "password" VARCHAR(255) NOT NULL,
    "status" INT2 DEFAULT 0 NOT NULL,
    "username" VARCHAR(45) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "archived_at" TIMESTAMP,
    PRIMARY KEY ("id_user")
);

CREATE INDEX "spy_user_archive_i_f86ef3" ON "spy_user_archive" ("username");

ALTER TABLE "spy_acl_rule" ADD CONSTRAINT "spy_acl_rule-fk_acl_role"
    FOREIGN KEY ("fk_acl_role")
    REFERENCES "spy_acl_role" ("id_acl_role")
    ON DELETE CASCADE;

ALTER TABLE "spy_acl_user_has_group" ADD CONSTRAINT "spy_acl_user_has_group-fk_user"
    FOREIGN KEY ("fk_user")
    REFERENCES "spy_user" ("id_user")
    ON DELETE CASCADE;

ALTER TABLE "spy_acl_user_has_group" ADD CONSTRAINT "spy_acl_user_has_group-fk_acl_group"
    FOREIGN KEY ("fk_acl_group")
    REFERENCES "spy_acl_group" ("id_acl_group")
    ON DELETE CASCADE;

ALTER TABLE "spy_acl_groups_has_roles" ADD CONSTRAINT "spy_acl_groups_has_roles-fk_acl_role"
    FOREIGN KEY ("fk_acl_role")
    REFERENCES "spy_acl_role" ("id_acl_role")
    ON DELETE CASCADE;

ALTER TABLE "spy_acl_groups_has_roles" ADD CONSTRAINT "spy_acl_groups_has_roles-fk_acl_group"
    FOREIGN KEY ("fk_acl_group")
    REFERENCES "spy_acl_group" ("id_acl_group")
    ON DELETE CASCADE;

ALTER TABLE "spy_auth_reset_password" ADD CONSTRAINT "spy_auth_reset_password-fk_user"
    FOREIGN KEY ("fk_user")
    REFERENCES "spy_user" ("id_user")
    ON DELETE CASCADE;

ALTER TABLE "spy_category" ADD CONSTRAINT "spy_category_fk_7e2c46"
    FOREIGN KEY ("fk_category_template")
    REFERENCES "spy_category_template" ("id_category_template");

ALTER TABLE "spy_category_attribute" ADD CONSTRAINT "spy_category_attribute_fk_12b6d0"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_category_attribute" ADD CONSTRAINT "spy_category_attribute_fk_723c48"
    FOREIGN KEY ("fk_category")
    REFERENCES "spy_category" ("id_category");

ALTER TABLE "spy_category_node" ADD CONSTRAINT "spy_category_node_fk_b54a47"
    FOREIGN KEY ("fk_parent_category_node")
    REFERENCES "spy_category_node" ("id_category_node");

ALTER TABLE "spy_category_node" ADD CONSTRAINT "spy_category_node_fk_723c48"
    FOREIGN KEY ("fk_category")
    REFERENCES "spy_category" ("id_category");

ALTER TABLE "spy_category_closure_table" ADD CONSTRAINT "spy_category_closure_table_fk_d3e44d"
    FOREIGN KEY ("fk_category_node")
    REFERENCES "spy_category_node" ("id_category_node");

ALTER TABLE "spy_category_closure_table" ADD CONSTRAINT "spy_category_closure_table_fk_a3476a"
    FOREIGN KEY ("fk_category_node_descendant")
    REFERENCES "spy_category_node" ("id_category_node");

ALTER TABLE "spy_cms_version" ADD CONSTRAINT "spy_cms_version-fk_user"
    FOREIGN KEY ("fk_user")
    REFERENCES "spy_user" ("id_user");

ALTER TABLE "spy_cms_version" ADD CONSTRAINT "spy_cms_version-fk_cms_page"
    FOREIGN KEY ("fk_cms_page")
    REFERENCES "spy_cms_page" ("id_cms_page")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_page" ADD CONSTRAINT "spy_cms_page-fk_template"
    FOREIGN KEY ("fk_template")
    REFERENCES "spy_cms_template" ("id_cms_template")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_page_localized_attributes" ADD CONSTRAINT "spy_cms_page_localized_attributes-fk_cms_page"
    FOREIGN KEY ("fk_cms_page")
    REFERENCES "spy_cms_page" ("id_cms_page")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_page_localized_attributes" ADD CONSTRAINT "spy_cms_page_localized_attributes-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_cms_glossary_key_mapping" ADD CONSTRAINT "spy_cms_glossary_key_mapping-fk_page"
    FOREIGN KEY ("fk_page")
    REFERENCES "spy_cms_page" ("id_cms_page")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_glossary_key_mapping" ADD CONSTRAINT "spy_cms_glossary_key_mapping-fk_glossary_key"
    FOREIGN KEY ("fk_glossary_key")
    REFERENCES "spy_glossary_key" ("id_glossary_key")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_glossary_key_mapping" ADD CONSTRAINT "spy_cms_block_glossary_key_mapping-fk_cms_block"
    FOREIGN KEY ("fk_cms_block")
    REFERENCES "spy_cms_block" ("id_cms_block")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_glossary_key_mapping" ADD CONSTRAINT "spy_cms_block_glossary_key_mapping-fk_glossary_key"
    FOREIGN KEY ("fk_glossary_key")
    REFERENCES "spy_glossary_key" ("id_glossary_key")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block" ADD CONSTRAINT "spy_cms_block-fk_template"
    FOREIGN KEY ("fk_template")
    REFERENCES "spy_cms_block_template" ("id_cms_block_template")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_store" ADD CONSTRAINT "spy_cms_block_store-fk_cms_block"
    FOREIGN KEY ("fk_cms_block")
    REFERENCES "spy_cms_block" ("id_cms_block");

ALTER TABLE "spy_cms_block_store" ADD CONSTRAINT "spy_cms_block_store-fk_store"
    FOREIGN KEY ("fk_store")
    REFERENCES "spy_store" ("id_store");

ALTER TABLE "spy_cms_block_category_connector" ADD CONSTRAINT "spy_cms_block_category_connector-fk_cms_block"
    FOREIGN KEY ("fk_cms_block")
    REFERENCES "spy_cms_block" ("id_cms_block")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_category_connector" ADD CONSTRAINT "spy_cms_block_category_connector-fk_category"
    FOREIGN KEY ("fk_category")
    REFERENCES "spy_category" ("id_category")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_category_connector" ADD CONSTRAINT "spy_cms_block_category_connector-fk_category_template"
    FOREIGN KEY ("fk_category_template")
    REFERENCES "spy_category_template" ("id_category_template")
    ON DELETE CASCADE;

ALTER TABLE "spy_cms_block_category_connector" ADD CONSTRAINT "spy_cms_block_category_connector-fk_cms_block_category_position"
    FOREIGN KEY ("fk_cms_block_category_position")
    REFERENCES "spy_cms_block_category_position" ("id_cms_block_category_position")
    ON DELETE CASCADE;

ALTER TABLE "spy_region" ADD CONSTRAINT "spy_region-fk_country"
    FOREIGN KEY ("fk_country")
    REFERENCES "spy_country" ("id_country");

ALTER TABLE "spy_customer" ADD CONSTRAINT "spy_customer-fk_user"
    FOREIGN KEY ("fk_user")
    REFERENCES "spy_user" ("id_user");

ALTER TABLE "spy_customer" ADD CONSTRAINT "spy_customer-default_billing_address"
    FOREIGN KEY ("default_billing_address")
    REFERENCES "spy_customer_address" ("id_customer_address")
    ON DELETE SET NULL;

ALTER TABLE "spy_customer" ADD CONSTRAINT "spy_customer-default_shipping_address"
    FOREIGN KEY ("default_shipping_address")
    REFERENCES "spy_customer_address" ("id_customer_address")
    ON DELETE SET NULL;

ALTER TABLE "spy_customer" ADD CONSTRAINT "spy_customer-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_customer_address" ADD CONSTRAINT "spy_customer_address-fk_customer"
    FOREIGN KEY ("fk_customer")
    REFERENCES "spy_customer" ("id_customer")
    ON DELETE CASCADE;

ALTER TABLE "spy_customer_address" ADD CONSTRAINT "spy_customer_address-fk_region"
    FOREIGN KEY ("fk_region")
    REFERENCES "spy_region" ("id_region");

ALTER TABLE "spy_customer_address" ADD CONSTRAINT "spy_customer_address-fk_country"
    FOREIGN KEY ("fk_country")
    REFERENCES "spy_country" ("id_country");

ALTER TABLE "spy_customer_group_to_customer" ADD CONSTRAINT "spy_customer_group_to_customer-fk_customer_group"
    FOREIGN KEY ("fk_customer_group")
    REFERENCES "spy_customer_group" ("id_customer_group")
    ON DELETE CASCADE;

ALTER TABLE "spy_customer_group_to_customer" ADD CONSTRAINT "spy_customer_group_to_customer-fk_customer"
    FOREIGN KEY ("fk_customer")
    REFERENCES "spy_customer" ("id_customer");

ALTER TABLE "spy_customer_note" ADD CONSTRAINT "spy_customer_note-fk_customer"
    FOREIGN KEY ("fk_customer")
    REFERENCES "spy_customer" ("id_customer");

ALTER TABLE "spy_customer_note" ADD CONSTRAINT "spy_customer_note-fk_user"
    FOREIGN KEY ("fk_user")
    REFERENCES "spy_user" ("id_user");

ALTER TABLE "spy_glossary_translation" ADD CONSTRAINT "spy_glossary_translation-fk_glossary_key"
    FOREIGN KEY ("fk_glossary_key")
    REFERENCES "spy_glossary_key" ("id_glossary_key")
    ON DELETE CASCADE;

ALTER TABLE "spy_glossary_translation" ADD CONSTRAINT "spy_glossary_translation-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale")
    ON DELETE CASCADE;

ALTER TABLE "spy_navigation_node" ADD CONSTRAINT "spy_navigation_node_fk_07636b"
    FOREIGN KEY ("fk_parent_navigation_node")
    REFERENCES "spy_navigation_node" ("id_navigation_node")
    ON DELETE CASCADE;

ALTER TABLE "spy_navigation_node" ADD CONSTRAINT "spy_navigation_node_fk_6f985c"
    FOREIGN KEY ("fk_navigation")
    REFERENCES "spy_navigation" ("id_navigation")
    ON DELETE CASCADE;

ALTER TABLE "spy_navigation_node_localized_attributes" ADD CONSTRAINT "spy_navigation_node_localized_attributes_fk_43843f"
    FOREIGN KEY ("fk_navigation_node")
    REFERENCES "spy_navigation_node" ("id_navigation_node")
    ON DELETE CASCADE;

ALTER TABLE "spy_navigation_node_localized_attributes" ADD CONSTRAINT "spy_navigation_node_localized_attributes_fk_12b6d0"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_navigation_node_localized_attributes" ADD CONSTRAINT "spy_navigation_node_localized_attributes_fk_76593a"
    FOREIGN KEY ("fk_url")
    REFERENCES "spy_url" ("id_url");

ALTER TABLE "spy_oauth_access_token" ADD CONSTRAINT "spy_oauth_access_token-identifier"
    FOREIGN KEY ("fk_oauth_client")
    REFERENCES "spy_oauth_client" ("identifier");

ALTER TABLE "spy_touch_storage" ADD CONSTRAINT "spy_touch_storage-fk_touch"
    FOREIGN KEY ("fk_touch")
    REFERENCES "spy_touch" ("id_touch");

ALTER TABLE "spy_touch_storage" ADD CONSTRAINT "spy_touch_storage-fk_store"
    FOREIGN KEY ("fk_store")
    REFERENCES "spy_store" ("id_store");

ALTER TABLE "spy_touch_storage" ADD CONSTRAINT "spy_touch_storage-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_touch_search" ADD CONSTRAINT "spy_touch_search-fk_touch"
    FOREIGN KEY ("fk_touch")
    REFERENCES "spy_touch" ("id_touch");

ALTER TABLE "spy_touch_search" ADD CONSTRAINT "spy_touch_search-fk_store"
    FOREIGN KEY ("fk_store")
    REFERENCES "spy_store" ("id_store");

ALTER TABLE "spy_touch_search" ADD CONSTRAINT "spy_touch_search-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale");

ALTER TABLE "spy_url" ADD CONSTRAINT "spy_url-fk_resource_categorynode"
    FOREIGN KEY ("fk_resource_categorynode")
    REFERENCES "spy_category_node" ("id_category_node")
    ON DELETE CASCADE;

ALTER TABLE "spy_url" ADD CONSTRAINT "spy_url-fk_resource_page"
    FOREIGN KEY ("fk_resource_page")
    REFERENCES "spy_cms_page" ("id_cms_page")
    ON DELETE CASCADE;

ALTER TABLE "spy_url" ADD CONSTRAINT "spy_url-fk_locale"
    FOREIGN KEY ("fk_locale")
    REFERENCES "spy_locale" ("id_locale")
    ON DELETE CASCADE;

ALTER TABLE "spy_url" ADD CONSTRAINT "spy_url-fk_resource_redirect"
    FOREIGN KEY ("fk_resource_redirect")
    REFERENCES "spy_url_redirect" ("id_url_redirect")
    ON DELETE CASCADE;

COMMIT;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'zed' => '
BEGIN;

DROP TABLE IF EXISTS "spy_acl_role" CASCADE;

DROP SEQUENCE "spy_acl_role_pk_seq";

DROP TABLE IF EXISTS "spy_acl_rule" CASCADE;

DROP SEQUENCE "spy_acl_rule_pk_seq";

DROP TABLE IF EXISTS "spy_acl_group" CASCADE;

DROP SEQUENCE "spy_acl_group_pk_seq";

DROP TABLE IF EXISTS "spy_acl_user_has_group" CASCADE;

DROP TABLE IF EXISTS "spy_acl_groups_has_roles" CASCADE;

DROP TABLE IF EXISTS "spy_auth_reset_password" CASCADE;

DROP SEQUENCE "spy_auth_reset_password_pk_seq";

DROP TABLE IF EXISTS "spy_category" CASCADE;

DROP SEQUENCE "spy_category_pk_seq";

DROP TABLE IF EXISTS "spy_category_attribute" CASCADE;

DROP SEQUENCE "spy_category_attribute_pk_seq";

DROP TABLE IF EXISTS "spy_category_node" CASCADE;

DROP SEQUENCE "spy_category_node_pk_seq";

DROP TABLE IF EXISTS "spy_category_closure_table" CASCADE;

DROP SEQUENCE "spy_category_closure_table_pk_seq";

DROP TABLE IF EXISTS "spy_category_node_page_search" CASCADE;

DROP SEQUENCE "spy_category_node_page_search_pk_seq";

DROP TABLE IF EXISTS "spy_category_tree_storage" CASCADE;

DROP SEQUENCE "spy_category_tree_storage_pk_seq";

DROP TABLE IF EXISTS "spy_category_node_storage" CASCADE;

DROP SEQUENCE "spy_category_node_storage_pk_seq";

DROP TABLE IF EXISTS "spy_category_template" CASCADE;

DROP SEQUENCE "spy_category_template_pk_seq";

DROP TABLE IF EXISTS "spy_cms_version" CASCADE;

DROP SEQUENCE "spy_cms_version_pk_seq";

DROP TABLE IF EXISTS "spy_cms_template" CASCADE;

DROP SEQUENCE "spy_cms_template_pk_seq";

DROP TABLE IF EXISTS "spy_cms_page" CASCADE;

DROP SEQUENCE "spy_cms_page_pk_seq";

DROP TABLE IF EXISTS "spy_cms_page_localized_attributes" CASCADE;

DROP SEQUENCE "spy_cms_page_localized_attributes_pk_seq";

DROP TABLE IF EXISTS "spy_cms_glossary_key_mapping" CASCADE;

DROP SEQUENCE "spy_cms_glossary_key_mapping_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_template" CASCADE;

DROP SEQUENCE "spy_cms_block_template_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_glossary_key_mapping" CASCADE;

DROP SEQUENCE "spy_cms_block_glossary_key_mapping_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block" CASCADE;

DROP SEQUENCE "spy_cms_block_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_store" CASCADE;

DROP SEQUENCE "id_cms_block_store_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_category_connector" CASCADE;

DROP SEQUENCE "spy_cms_block_category_connector_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_category_position" CASCADE;

DROP SEQUENCE "spy_cms_block_category_position_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_category_storage" CASCADE;

DROP SEQUENCE "spy_cms_block_category_storage_pk_seq";

DROP TABLE IF EXISTS "spy_cms_block_storage" CASCADE;

DROP SEQUENCE "spy_cms_block_storage_pk_seq";

DROP TABLE IF EXISTS "spy_cms_page_search" CASCADE;

DROP SEQUENCE "spy_cms_page_search_pk_seq";

DROP TABLE IF EXISTS "spy_cms_page_storage" CASCADE;

DROP SEQUENCE "spy_cms_page_storage_pk_seq";

DROP TABLE IF EXISTS "spy_country" CASCADE;

DROP SEQUENCE "spy_country_pk_seq";

DROP TABLE IF EXISTS "spy_region" CASCADE;

DROP SEQUENCE "spy_region_pk_seq";

DROP TABLE IF EXISTS "spy_currency" CASCADE;

DROP SEQUENCE "spy_currency_pk_seq";

DROP TABLE IF EXISTS "spy_customer" CASCADE;

DROP SEQUENCE "spy_customer_pk_seq";

DROP TABLE IF EXISTS "spy_customer_address" CASCADE;

DROP SEQUENCE "spy_customer_address_pk_seq";

DROP TABLE IF EXISTS "spy_customer_group" CASCADE;

DROP SEQUENCE "spy_customer_group_pk_seq";

DROP TABLE IF EXISTS "spy_customer_group_to_customer" CASCADE;

DROP SEQUENCE "spy_customer_group_to_customer_pk_seq";

DROP TABLE IF EXISTS "spy_customer_note" CASCADE;

DROP SEQUENCE "spy_customer_note_pk_seq";

DROP TABLE IF EXISTS "spy_event_behavior_entity_change" CASCADE;

DROP SEQUENCE "spy_event_behavior_entity_change_pk_seq";

DROP TABLE IF EXISTS "spy_glossary_key" CASCADE;

DROP SEQUENCE "spy_glossary_key_pk_seq";

DROP TABLE IF EXISTS "spy_glossary_translation" CASCADE;

DROP SEQUENCE "spy_glossary_translation_pk_seq";

DROP TABLE IF EXISTS "spy_glossary_storage" CASCADE;

DROP SEQUENCE "spy_glossary_storage_pk_seq";

DROP TABLE IF EXISTS "spy_locale" CASCADE;

DROP SEQUENCE "spy_locale_pk_seq";

DROP TABLE IF EXISTS "spy_navigation" CASCADE;

DROP SEQUENCE "spy_navigation_pk_seq";

DROP TABLE IF EXISTS "spy_navigation_node" CASCADE;

DROP SEQUENCE "spy_navigation_node_pk_seq";

DROP TABLE IF EXISTS "spy_navigation_node_localized_attributes" CASCADE;

DROP SEQUENCE "spy_navigation_node_localized_attributes_pk_seq";

DROP TABLE IF EXISTS "spy_navigation_storage" CASCADE;

DROP SEQUENCE "spy_navigation_storage_pk_seq";

DROP TABLE IF EXISTS "spy_oauth_access_token" CASCADE;

DROP SEQUENCE "spy_oauth_access_token_pk_seq";

DROP TABLE IF EXISTS "spy_oauth_client" CASCADE;

DROP SEQUENCE "spy_oauth_client_pk_seq";

DROP TABLE IF EXISTS "spy_oauth_scope" CASCADE;

DROP SEQUENCE "spy_oauth_scope_pk_seq";

DROP TABLE IF EXISTS "spy_permission" CASCADE;

DROP SEQUENCE "spy_permission_pk_seq";

DROP TABLE IF EXISTS "spy_propel_heartbeat" CASCADE;

DROP TABLE IF EXISTS "spy_queue_process" CASCADE;

DROP SEQUENCE "spy_queue_process_pk_seq";

DROP TABLE IF EXISTS "spy_sales_order" CASCADE;

DROP TABLE IF EXISTS "spy_sequence_number" CASCADE;

DROP SEQUENCE "spy_sequence_number_pk_seq";

DROP TABLE IF EXISTS "spy_store" CASCADE;

DROP SEQUENCE "spy_store_pk_seq";

DROP TABLE IF EXISTS "spy_touch" CASCADE;

DROP SEQUENCE "spy_touch_pk_seq";

DROP TABLE IF EXISTS "spy_touch_storage" CASCADE;

DROP SEQUENCE "spy_touch_storage_pk_seq";

DROP TABLE IF EXISTS "spy_touch_search" CASCADE;

DROP SEQUENCE "spy_touch_search_pk_seq";

DROP TABLE IF EXISTS "spy_unauthenticated_customer_access" CASCADE;

DROP SEQUENCE "spy_unauthenticated_customer_access_pk_seq";

DROP TABLE IF EXISTS "spy_unauthenticated_customer_access_storage" CASCADE;

DROP SEQUENCE "unauthenticated_customer_access_storage_pk_seq";

DROP TABLE IF EXISTS "spy_url" CASCADE;

DROP SEQUENCE "spy_url_pk_seq";

DROP TABLE IF EXISTS "spy_url_redirect" CASCADE;

DROP SEQUENCE "spy_url_redirect_pk_seq";

DROP TABLE IF EXISTS "spy_url_storage" CASCADE;

DROP SEQUENCE "spy_url_storage_pk_seq";

DROP TABLE IF EXISTS "spy_url_redirect_storage" CASCADE;

DROP SEQUENCE "spy_url_redirect_storage_pk_seq";

DROP TABLE IF EXISTS "spy_user" CASCADE;

DROP SEQUENCE "spy_user_pk_seq";

DROP TABLE IF EXISTS "spy_acl_role_archive" CASCADE;

DROP TABLE IF EXISTS "spy_acl_rule_archive" CASCADE;

DROP TABLE IF EXISTS "spy_acl_group_archive" CASCADE;

DROP TABLE IF EXISTS "spy_auth_reset_password_archive" CASCADE;

DROP TABLE IF EXISTS "spy_user_archive" CASCADE;

COMMIT;
',
);
    }

}