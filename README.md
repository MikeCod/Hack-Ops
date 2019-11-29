# Hack Ops
Hack Ops is a website for pentest training

## License
Hack Ops is under [MIT](https://choosealicense.com/licenses/mit/) license

## Installation
You'll need a virtual machine for challenges.
You'll also need to install V8 to execute JavaScript on the server (used for CSRF training)
```bash
apt-get update
apt-get install libnode-dev
```
The virtual machine **must not** use root session. Because Hack Ops's users have an important control on the machine (like access to databases or execute commands)

## Copyrights
SweetAlert
V8