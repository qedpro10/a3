# Refer the start of Week 8's lecture for installation/usage instructions
#
# Notes:
# This file must have executable permissions in order to run: chmod +x deploy
# This file assumes you have a SSH key working for connections to your DigitalOcean server


#
# CONFIGURATION
#
# Update to be the path to your application on DigitalOcean
appPath='/var/www/html/a3'

# Update to reflect how you SSH into your DigitalOcean server
sshLogin=root@138.197.40.213


#
# Function to output messages
#
function dump {
    echo -e "===> \033[1m"$1"\033[0m"
}


#
#
#
function doDeploy {

    # Do a git status
    status=$(cd $appPath; git status)

    # Only proceed with deployment if git status shows there are no changes
    if [[ $status == *"nothing to commit, working directory clean"* ]]; then
        dump "Working directory clean on production, proceeding with deployment."
        git pull
        composer install
    # If there are changes, abort deployment
    else
        dump "There are changes on your production server; aborting deployment."
        dump "SSH into your production server to commit/checkout those changes and then try again."
    fi
}


#
# Decide what to do when this script is run
#
# If running this script on production, invoke doDeploy
if [[ $(pwd) == *"/var/www/html"* ]]; then
    doDeploy
# If running this script on local, invoke doDeploy via SSH
else
    ssh $sshLogin "cd $appPath; ./deploy";
fi
