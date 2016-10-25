@echo off & cls
:loop
    for %%A in (".\tag\*") do (
        rundll32 mshtml.dll,PrintHTML "%%~fA" "Microsoft XPS Document Writer"
        del %%~fA
        @ping 127.0.0.1 -n 1 -w 1000 > nul
    )
    ::for %%A in (".\list\*") do (
    ::    rundll32 mshtml.dll,PrintHTML "%%~fA" "Microsoft Print to PDF"
    ::    del %%~fA
    ::    @ping 127.0.0.1 -n 1 -w 1000 > nul
    ::)
    @ping 127.0.0.1 -n 3 -w 1000 > nul
goto loop