<?php

class buttonProvider{
    public static $signInFunction = "notSignedIn()";

    public static function createLink($link) {
        return user::isLoggedIn() ? $link : buttonProvider::$signInFunction;
    
    }

    public static function createButton($text, $imageSrc, $action, $class){

        $image = ($imageSrc==null) ? "" : "<image src='$imageSrc'>";

        $action = buttonProvider::createlink($action);

        return "<button class='$class' onclick='$action'>
                $image
                <span class='text'>$text</span>
                </button>";
    }

    public static function createHyperlinkButton($text, $imageSrc, $href, $class){

        $image = ($imageSrc == null) ? "" : "<image src='$imageSrc'>";

        return "<a href='$href'>
                    <button class='$class'>
                        $image
                        <span class='text'>$text</span>
                    </button>
                </a>";
    }

    public static function createUserProfileButton($con, $username){
        $userObj = new user($con, $username);
        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";

        return "<a href='$link'>
                    <img src='$profilePic' class='profilePicture'>
                </a>";
    }

    public static function createEditVideoButton($videoId){
        $href = "editVideo.php?videoId=$videoId";

        $button = buttonProvider::createHyperlinkButton("EDIT VIDEO", null,$href,"edit button");

        return "<div class='editVideoButtonContainer'>
                    $button
                </div>";
    }

    public static function createSubscriberButton($con, $userToObj, $userLoggedInObj){
        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();

        $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
        $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userToObj->getSubscriberCount();

        $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

        $button = buttonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='subscribeButtonContainer'>
                    $button
                </div>";
    }

    public function createUserNavigationButton($con, $username){
        if(user::isLoggedIn()){
            return buttonProvider::createUserProfileButton($con, $username);
        }
        else{

            return "<a href='signIn.php'>
                        <span class='signInLink'>SIGN IN</span>
                    </a>";
        }
    }

}


?>