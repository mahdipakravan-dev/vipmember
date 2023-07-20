<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class VipDBHelper
{
    // Constants for table names
    const VIP_PLANS_TABLE = 'vip__plans';

    /**
     * Get the table name with the appropriate WordPress prefix
     *
     * @param string $table_name The name of the table without the prefix
     * @return string The table name with the WordPress prefix
     */
    public static function get_table_name($table_name)
    {
        global $wpdb;
        return $wpdb->prefix . $table_name;
    }


    /**
     * Insert data into the database table
     *
     * @param string $table_name The name of the table without the prefix
     * @param array $data An associative array of data to insert (column_name => value)
     * @return int|false The number of rows affected on success, or false on failure
     */
    public static function insert_data($table_name, $data)
    {
        global $wpdb;

        $table_name = self::get_table_name($table_name);

        // Insert the data into the table using the $wpdb->insert() method
        $result = $wpdb->insert($table_name, $data);

        return $result;
    }

    public static function create_table($query)
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = $query . "$charset_collate;";

        dbDelta($sql);
    }
}
