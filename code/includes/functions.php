<?php
function loadMenu($mysqli) {
    $categories = [];
    $query = "SELECT id, name FROM categories ORDER BY display_order ASC, id ASC";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'dishes' => []
        ];
    }

    foreach ($categories as &$category) {
        $query = "SELECT id, name, price FROM dishes WHERE category_id = " . $category['id'];
        $result = $mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $category['dishes'][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price']
            ];
        }
    }

    return $categories;
}
?>
