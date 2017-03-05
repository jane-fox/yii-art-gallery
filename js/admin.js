
function _bind_comic_preview() {

    $(".comic-content-field").on("change",function() {

        $preview = $(this).parent().find(".comic-content-preview");
        new_url = $preview.attr("data-base-url") + $(this).val() + "";

        $preview.attr("src",new_url);

    });

}

function _bind_page_delete() {
    $(".delete-page").on("click",function() {

        $(this).parent().remove();

    });
}

$(function() {

    $("#list-table").tablesorter();



    if ($("#add-comic-page").length > 0) {

        $("#add-comic-page").on("click", function() {

            page_template = $(".comic-page").last();

            $(page_template).clone().appendTo("#comic-pages");

            _bind_comic_preview();
            _bind_page_delete();

        });

    }


    _bind_comic_preview();
    _bind_page_delete();



    $(".edit-button").one("click", function() {

        $rows = $(this).closest(".data-row").find(".data-cell");

        for (i=0;i<$rows.length;i++) {

            field = '<input type="text" name="item[' + $($rows[i]).attr("data-row-id") + '][' + $($rows[i]).attr("data-key") + ']" value="' + $($rows[i]).attr("data-val") + '" />';

            if ($($rows[i]).attr("data-key") != "id") {

                $($rows[i]).append(field);

            }

            $(".save-btn").removeClass("hidden");

        }


    });




}); // onload

