#!/bin/bash
GPHOTO=$1
BASE=$2
cd "$BASE/raw"
FILENAME="photo_%y-%m-%d_%H-%M-%S-%n.%C"
"$GPHOTO" --capture-image-and-download --filename="$FILENAME" --hook-script="$BASE/resize.sh"