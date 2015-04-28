# baka

# Ivo Pure 104269

# ToDO: Done,
BotInjector turvalisus, st human check?
session timeout? Serverside! koodus pole soovitatav.
---
*Kõik POST requestid peavad olema üle https, st TLS nt, SSL3 on buggine ning üldiselt depircated.
Parooli saatmisel serverisse on ekstra turvalisuse mõttes mõistlik hashida parool, pigem paranoia.

SQL injection: PD objects. Eelvalmistatakse query, siis täidetakse. Mitte ala sql = "SELECT * FROM admin where id={$input}";
When using Prepared Statements with PDO::prepare() and PDOStatement::execute(), you don't have any quoting to do : this will be done automatically.

PDO charset=utf8 piirab erimärke.
Many new attack vectors rely on encoding bypassing. Use UTF-8 as your database and application charset unless you have a mandatory requirement to use another encoding.
https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet

The password_hash function returns a string that contains both the hash and the salt.
ST Username DB-s ei hoia. Hoiame Hsh(PW + Salt) , pärast võrdleme logimisel seda tuletatud hashi

Miinus minul: Kui ei kasutaks PHP sessi:  If you did that, store session data in a database. Sess infi DB eraldi tabel + Unique veerg.
http://www.thespanner.co.uk/2007/12/02/faking-the-unexpected/   PHP IP
User agent + SRC ip -> Sess

Change Sess ID on Logon and kill everything on logoff. Set Sess Timeout. 
Iga AJAX req tuleb KT: (req.id, sessID), IP, Browser.

The PHP session is stored in webserver's memory while JavaScript runs in the webclient (webbrowser). 
Those are in real world two physically separate and independent machines. They usually can only communicate with each other over network using HTTP protocol.

Suur viga oleks X-ff-is IP võtta, requestide craftimine on väga primitiivne

it's much more complex than that. Your site/service will be accessed by a variety of people with different 
setups. The first thing that can go wrong is if someone is going through a proxy server. 
The IP that your app will see can change, and the session will break even for a valid user.
If you absolutely need to do something with the IP, the most you can do without getting 
too many false positives is checking the originating country/region. If you detect one 
login from Canada and another one from India, there might be an issue. Even then, it's not fool-proof.

Ütleme nii, et pole vaja proxytada. Kui inimene ennast proxy taga peidab, siis tal on juba teised eesmärgid.

---
You can also use an additional time stamp to regenerate the session ID periodically to avoid attacks on sessions like session fixation:

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
----
// remove all session variables
session_unset();
$_SESSION=array();

// destroy the session 
session_destroy(); 
----
session_start();
session_regenerate_id() will replace the current session id with a new one, and keep the current session information.
