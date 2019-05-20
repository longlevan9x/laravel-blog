<?php
if (!function_exists('responseJson')) {
    /**
     * @param string $message
     * @param mixed  $data
     * @param int    $status
     * @param array  $header
     * @param int    $option
     * @return \Illuminate\Http\JsonResponse
     */
    function responseJson($message = '', $data = [], $status = 200, array $header = ['Content-type' => "application/json"], $option = JSON_NUMERIC_CHECK) {
        header("Content-type: application/application/json");

        return response()->json([
            'message' => $message,
            'status'  => $status,
            'result'  => $data
        ], $status = 200, $header, $option);
    }
}

if (!function_exists("get_hidden_columns")) {
    /**
     * @param array|string $columns
     * @param array $column_fillable
     * @param string $delimiter
     * @return array
     */
    function get_hidden_columns($column_fillable, $columns, $delimiter = ',') {
    	if(empty($columns)) {
    		return [];
	    }

        if (is_string($columns)) {
            $columns = explode($delimiter, $columns);
        }

        foreach ($column_fillable as $key => $column) {
            if (in_array($column, $columns)) {
                unset($column_fillable[$key]);
            }
        }
        return $column_fillable;
    }
}
