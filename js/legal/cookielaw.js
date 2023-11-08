// European cookie law code

var dropCookie = true;                          // false disables the Cookie, allowing you to style the banner
var cookieDuration = 14;                        // Number of days before the cookie expires, and the banner reappears
var cookieName = 'complianceCookie';            // Name of our cookie
var cookieValue = 'on';                         // Value of cookie
var currentPage = window.location.pathname;     // Current Page
var exclusions = ["cookies-policy"];            // Exclude pop up from these pages (usually the cookies policy)
 
function createDiv(){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-law');
    div.innerHTML = '<div class="cookie-popup"><h4><i class="fal fa-cookie-bite"></i> This site uses cookies</h4><p>Our website uses cookies. By continuing we assume your permission to deploy cookies, as detailed in our cookies policy.</p><p>Some cookies are strictly necessary to operate our website, such as the ones that remember your preference to the below option.</p><p>However, you can opt-out of our optional and anonymous marketing cookies by clicking decline below.</p>' + 
                    '<a href="/cookies-policy" rel="nofollow" title="Cookies Policy">See our cookies policy</a>.</p>' +
                    '<a class="cookie-btn cookie-decline" href="javascript:void(0);" onclick="declineCookies();"><i class="fas fa-times-square" aria-hidden="true"></i> Decline</a><a class="cookie-btn cookie-accept" href="javascript:void(0);" onclick="acceptCookies();"><i class="fas fa-check" aria-hidden="true"></i> Accept</a></div>';    
    // Be advised the Close Banner 'X' link requires jQuery
     
    // bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
    // or
    bodytag.insertBefore(div,bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
     
    document.getElementsByTagName('body')[0].className+=' cookiebanner'; //Adds a class tothe <body> tag when the banner is visible
}
 
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000)); 
        var expires = "; expires="+date.toGMTString(); 
    }
    else var expires = "";
    if(window.dropCookie) { 
        document.cookie = name+"="+value+expires+"; path=/"; 
    }
}
 
function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
 
function eraseCookie(name) {
    createCookie(name,"",-1);
}
 
window.onload = function(){
    currentPage = currentPage.replace(/^.*\/([^/]+)\/?$/, "$1");
    if (exclusions.includes(currentPage)) {

    } else {
        if(checkCookie(window.cookieName) != window.cookieValue){
            createDiv();
        }
    }

    if (checkCookie("GoogleConsent")) {
        // Grant Google Cookie Consent
        gtag('consent', 'update', {
            'ad_storage': 'granted',
            'analytics_storage': 'granted'
        });
    }
}

function acceptCookies(){
    var element = document.getElementById('cookie-law');
    element.parentNode.removeChild(element);
    createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie

    // Create Google Consent Cookie
    createCookie("GoogleConsent", "yes", window.cookieDuration);

    // Grant Google Cookie Consent
    gtag('consent', 'update', {
        'ad_storage': 'granted',
        'analytics_storage': 'granted'
    });
}

function declineCookies() {
    var element = document.getElementById('cookie-law');
    element.parentNode.removeChild(element);
    createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
}