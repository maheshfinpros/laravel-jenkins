pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Install MySQL and Create Database') {
            steps {
                script {
                    try {
                        sh 'sudo apt-get update -y && sudo apt-get install -y mysql-server' // Install MySQL

                        // Check if the database already exists
                        def dbExists = sh(script: "sudo mysql -e \"SHOW DATABASES LIKE 'maheshfinpros'\"", returnStatus: true) == 0

                        if (!dbExists) {
                            // If the database doesn't exist, create it
                            sh 'sudo mysql -e "CREATE DATABASE maheshfinpros"' // Create database
                            sh 'sudo mysql -e "CREATE USER \'mahesh.m\'@\'localhost\' IDENTIFIED BY \'mahesh123\'"' // Create user
                            sh 'sudo mysql -e "GRANT ALL PRIVILEGES ON maheshfinpros.* TO \'mahesh.m\'@\'localhost\'"' // Grant privileges
                            sh 'sudo mysql -e "FLUSH PRIVILEGES"' // Flush privileges
                        } else {
                            echo "Database maheshfinpros already exists."
                        }
                    } catch (Exception e) {
                        error "Failed to install MySQL and create database: ${e.message}"
                    }
                }
            }
        }

        stage('Build App') {
            steps {
                // Build your Laravel application
                sh 'composer install'
                sh 'php artisan optimize' // Use `optimize` instead of `build`
            }
        }

        stage('Zipping project') {
            steps {
                // Zip your entire repository files
                sh 'zip -r project.zip .'
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                // Upload zip file to remote server's /var/www directory
                sh 'scp -i /var/lib/jenkins/.ssh/jenkins_rsa project.zip ubuntu@13.201.8.1:/var/www/project.zip'
            }
        }

        stage('Extracting Project') {
            steps {
                // Extract zip file on the target server
                sh 'ssh -i /var/lib/jenkins/.ssh/jenkins_rsa ubuntu@13.201.8.1 "cd /var/www/ && unzip -o project.zip"'
            }
        }

        stage('git-checkout') {
            steps {
                checkout scmGit(branches: [[name: '*/master']], extensions: [], userRemoteConfigs: [[credentialsId: 'git-hub-cred', url: 'https://github.com/ShekharRedd/shekhar-laravel.git']])
            }
        }

        stage("install dependencys"){
            steps{
                script{
                    sh "composer install"
                }
            }
        }
        
        stage("Write the commands to execute"){
            steps{
                script{
                    sh """
                    
                    cat <<EOF> db_script.sh 
                    php artisian make:migrate
                    php artisian migrate
                    EOF
                    """
                }
            }
        }

        stage("Deploying laravel-ec2-instance-application") {
            steps {
                script {
                    sshagent(credentials: ['ssh-keys']) {
                        // Copy files to the EC2 instance using rsync
                        // sh "rsync -avz --exclude='.git' -e 'ssh -o StrictHostKeyChecking=no' -r /var/lib/jenkins/workspace/copy-files-1 ec2-user@34.227.224.6:/home/ec2-user/"
                        sh "rsync -e 'ssh -o StrictHostKeyChecking=no' -r --exclude='.git' copy-files-1/ ec2-user@172.31.21.138:/home/ec2-user/"
                        // SSH into the EC2 instance and list files
                        sh "ssh ec2-user@34.227.224.6 'cd /home/ec2-user/copy-files-1/ && ls -l && ./db_script.sh'"
                    }
                }
            }
        } 
    }
}
