# test-sf5
### This project is only about testing SF% new features
To run command about DB use symfony console instead of php bin/console
To run it, dont forget to `docker-compose up -d` :) and to start the server ofc !
To handle message sycnhronously, launch the worker (for dev, watch some folder)
`symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async`
To stop consume
`symfony console messenger:stop-workers`

check the port to catchmail, it change on every docker-compose up (check server parameter in profiler as instance)
 -> change port in mailer.yaml cuz docker force us to rebuild when .env change...
 `symfony open:local:webmail`