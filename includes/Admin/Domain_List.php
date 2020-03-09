<?php

namespace Domain\Manager\Admin;


if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List Table Class
 */
class Domain_List extends \WP_List_Table {

    function __construct() {
        parent::__construct( [
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false
        ] );
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'No Domain found', 'domain-manager' );
    }

    /**
     * Get the column names
     *
     * @return array
     */
    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'domain_name'       => __( 'Domain Name', 'domain-manager' ),
            'priority'    => __( 'Prioriry', 'domain-manager' ),
            'category'      => __( 'Category', 'domain-manager' ),
            'created_by'      => __( 'Created By', 'domain-manager' ),
            'description'      => __( 'Description', 'domain-manager' ),
            'status'      => __( 'Status', 'domain-manager' ),
            'created_at' => __( 'Date', 'domain-manager' ),
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'domain_name'       => [ 'domain_name', true ],
            'priority'       => [ 'priority', true ],
            'created_at' => [ 'created_at', true ],
            'status' => [ 'status', true ],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'domain-manager' ),
        );

        return $actions;
    }

    /**
     * Default column values
     *
     * @param  object $item
     * @param  string $column_name
     *
     * @return string
     */
    protected function column_default( $item, $column_name ) {

        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    /**
     * Render the "name" column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_name( $item ) {
        $actions = [];

        $actions['edit']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=domain-manager&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'domain-manager' ), __( 'Edit', 'domain-manager' ) );
        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=wd-ac-delete-address&id=' . $item->id ), 'wd-ac-delete-address' ), $item->id, __( 'Delete', 'domain-manager' ), __( 'Delete', 'domain-manager' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=domain-manager&action=view&id' . $item->id ), $item->name, $this->row_actions( $actions )
        );
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Prepare the address items
     *
     * @return void
     */
    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        $this->items = wp_get_data( $args );

        $this->set_pagination_args( [
            'total_items' => wp_table_count(),
            'per_page'    => $per_page
        ] );
    }
}
