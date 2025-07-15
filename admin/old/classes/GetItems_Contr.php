<?php

// Get items
class GetItems_Contr extends GetItems_Model {

    protected function contr_getItems() {
        return $this->model_getItems();
    }

    // return Item Data
    protected function contr_rID() {
        return $this->model_gID();
    }
}