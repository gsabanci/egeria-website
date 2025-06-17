$(".dd").nestable({ maxDepth: 3 });
let categories = [];
const btnPosition = document.getElementById("btnPosition");
btnPosition.addEventListener("click", (e) => {
    categories = $(".dd").nestable("serialize");
    $("#save_category_order").val(JSON.stringify(categories));
    $("#save_category_order_form").submit();
});
