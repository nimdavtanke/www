#!/usr/bin/perl -Tw
#
# Env by ZayDen
#
use CGI qw(:standard);
use strict;
use warnings qw(redefine);
# use ModPerl::Registry;
print "Content-type:image/html\n\n";
print "<br>\n";
foreach (sort keys %ENV)
{
    print "<b>$_</b>: $ENV{$_}<br>\n";
}

1;
