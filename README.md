# test-sf5
### This project is only about testing SF% new features
To run it, dont forget to `docker-compose up` :)
To handle message sycnhroniously, launch the worker (for dev, watch some folder)
`symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async`
