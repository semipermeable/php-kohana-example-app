<?php
// detach the default log writer
Kohana::$log->detach($syslogwriter);
// re-attach the new log writer with limited log level
Kohana::$log->attach(new Log_Syslog(), $levels=array(
    Kohana_Log::EMERGENCY,
    Kohana_Log::ALERT,
    Kohana_Log::CRITICAL,
    Kohana_Log::ERROR
));