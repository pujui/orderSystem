@echo off & cls
echo "10s 後開始自動執行, 請縮小視窗"
@ping 127.0.0.1 -n 5 -w 1000 > nul

echo "5s 後開始自動執行, 請縮小視窗"
@ping 127.0.0.1 -n 2 -w 1000 > nul

echo "3s 後開始自動執行, 請縮小視窗"
@ping 127.0.0.1 -n 3 -w 1000 > nul

echo "開始執行"
:loop
    @ping 127.0.0.1 -n 1 -w 1000 > nul
    JavaRobot\dist\JavaRobot.jar
goto loop