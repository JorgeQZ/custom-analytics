<?php


if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

// Extending class
class CA_ExpoVideos extends WP_List_Table
{
    // Here we will add our code
    private $table_data;
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'user_id'          => __('user_id', 'expovideos_analytics'),
                'video_id'         => __('video_id', 'expovideos_analytics'),
                'date' => __('date', 'expovideos_analytics')

        );
        return $columns;
    }

    function prepare_items()
    {
        //data
        $this->table_data = $this->get_table_data();

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);

        usort($this->table_data, array(&$this, 'usort_reorder'));

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page');
        echo $per_page;
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);

        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $this->set_pagination_args(array(
                'total_items' => $total_items, // total number of items
                'per_page'    => $per_page, // items to show on a page
                'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
        ));

        $this->items = $this->table_data;

    }

    private function get_table_data() {
        global $wpdb;

        $table = $wpdb->prefix . 'expovideos';

        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'id':
                case 'user_id':
                case 'video_id':
                case 'date':
                default:
                    return $item[$column_name];
          }
    }

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="element[]" value="%s" />',
                $item['id']
        );
    }

    protected function get_sortable_columns(){
      $sortable_columns = array(
            'user_id'  => array('user_id', false),
            'video_id' => array('video_id', false),
            'date'   => array('date', true)
      );
      return $sortable_columns;
    }

    function usort_reorder($a, $b)
    {
        // If no sort, default to user_login
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);

        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }

}


// Plugin menu callback function
function supporthost_list_init()
{
      // Creating an instance
      $table = new CA_EXpoVideos();

      echo '<div class="wrap"><h2>SupportHost Admin Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}