@echo off
start "" "C:\xampp\xampp-control.exe"
ping localhost -n 3 > nul
start "" "C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"
exit