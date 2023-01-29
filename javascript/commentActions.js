function postComment(button, postedBy, videoId, replyTo , containerClass){
    var textarea = $(button).siblings("textarea");
    var commentText = textarea.val();
    textarea.val("")

    if(commentText){
        $.post("ajax/postComment.php", {commentText: commentText, postedBy: postedBy, 
            videoId: videoId, responseTo: replyTo})
        .done(function(comment){
            $("." + containerClass).prepend(comment);
        })

    }
    else{
        alert("cannot insert an empty comment");
    }
}

function toggleReply(button) {
    var parent = $(button).closest(".itemContainer");
    var commentForm = parent.find(".commentForm").first();

    commentForm.toggleClass("hidden");
}

function getReplies(commentId, button, videoId) {
    $.post("ajax/getCommentReplies.php", { commentId: commentId, videoId: videoId })
    .done(function(comments) {
        var replies = $("<div>").addClass("repliesSection");
        replies.append(comments);

        $(button).replaceWith(replies);
    });
}