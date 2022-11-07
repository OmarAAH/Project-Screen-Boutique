window.addEventListener("close-modal", (event) => {
    $("#productModal").modal("hide");
    $("#updateProductModal").modal("hide");
    $("#deleteProductModal").modal("hide");
    $("#ColorModal").modal("hide");
    $("#TypeModal").modal("hide");
    $("#SizeModal").modal("hide");
    $("#deleteEmployeeModal").modal("hide");
    $("#updateEmployeeModal").modal("hide");
    $("#userModal").modal("hide");
    $("#updateUserModal").modal("hide");
    $("#createDesignerModal").modal("hide");
    $("#updateDesignerModal").modal("hide");
    $("#deleteDesignerModal").modal("hide");
    $("#createDesignModal").modal("hide");
    $("#updateDesignModal").modal("hide");
    $("#deleteDesignModal").modal("hide");
    $("#updateClientModal").modal("hide");
    $("#deleteClientModal").modal("hide");
    $("#createSalesModal").modal("hide");
    $("#dateDeliveryModal").modal("hide");
    $("#createDeliveryModal").modal("hide");


});

// VER Y OCULTAR CONTRASEÑA
function seePassword(id) {
    let $input = document.getElementById(id);
    if ($input.type == "password") {
        $input.type = "text";
    } else {
        $input.type = "password";
    }
}
