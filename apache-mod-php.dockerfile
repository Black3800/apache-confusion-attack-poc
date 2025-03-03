FROM httpd:2.4.59
RUN apt update
RUN apt install -y libjs-jquery-jfeed libapache2-mod-php davical perl libcgi-session-perl
