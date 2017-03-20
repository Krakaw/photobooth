#!/bin/bash
if [ "$ACTION" = "download" ]; then
    #OSX
    #sips -Z 1024 $ARGUMENT --out "../photos/$ARGUMENT"
    #/usr/local/bin/jpegoptim -m60 -o -p --strip-all "../photos/$ARGUMENT"
    convert $ARGUMENT -resize 1024x768 -quality 60 "../photos/$ARGUMENT"
    #cp $ARGUMENT "../photos/$ARGUMENT"
echo ""
fi
exit
