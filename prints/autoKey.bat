@echo off & cls
echo "10s ��}�l�۰ʰ���, ���Y�p����"
@ping 127.0.0.1 -n 5 -w 1000 > nul

echo "5s ��}�l�۰ʰ���, ���Y�p����"
@ping 127.0.0.1 -n 2 -w 1000 > nul

echo "3s ��}�l�۰ʰ���, ���Y�p����"
@ping 127.0.0.1 -n 3 -w 1000 > nul

echo "�}�l����"
:loop
    @ping 127.0.0.1 -n 1 -w 1000 > nul
    JavaRobot\dist\JavaRobot.jar
goto loop