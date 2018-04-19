#!/usr/bin/perl -Tw
#
# Env by ZayDen
#
use CGI qw(:standard);
use strict;
use warnings qw(redefine);
# use ModPerl::Registry;
print "Content-type:image/html\n\n";

my $str_LATITUDE=($ENV {'HTTP_GEOIP_LATITUDE'});
print "var lat = $str_LATITUDE;\n";
my $str_LONGITUDE=($ENV {'HTTP_GEOIP_LONGITUDE'});
print "var lng = $str_LONGITUDE;\n";

