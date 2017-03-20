#!/bin/bash
sudo killall pcscd
sudo /usr/sbin/pcscd -fda
sudo killall PTPCamera
