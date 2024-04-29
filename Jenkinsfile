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
                sh 'sudo apt-get update -y && sudo apt-get install -y mysql-server' // Install MySQL
                sh 'sudo mysql -e "CREATE DATABASE maheshfinpros"' // Create database
                sh 'sudo mysql -e "CREATE USER \'mahesh.m\'@\'localhost\' IDENTIFIED BY \'mahesh123\'"' // Create user
                sh 'sudo mysql -e "GRANT ALL PRIVILEGES ON maheshfinpros.* TO \'mahesh.m\'@\'localhost\'"' // Grant privileges
                sh 'sudo mysql -e "FLUSH PRIVILEGES"' // Flush privileges
            }
        }

        stage('Prepare Environment') {
            steps {
                sh 'cp /var/lib/jenkins/workspace/Jenkins-Laravel/.env.example /var/lib/jenkins/workspace/Jenkins-Laravel/.env' // Rename .env.example to .env
                // Update .env file
                sh 'sed -i "s/DB_HOST=.*/DB_HOST=127.0.0.1/" /var/lib/jenkins/workspace/Jenkins-Laravel/.env'
                sh 'sed -i "s/DB_PORT=.*/DB_PORT=3306/" /var/lib/jenkins/workspace/Jenkins-Laravel/.env'
                sh 'sed -i "s/DB_DATABASE=.*/DB_DATABASE=maheshfinpros/" /var/lib/jenkins/workspace/Jenkins-Laravel/.env'
                sh 'sed -i "s/DB_USERNAME=.*/DB_USERNAME=mahesh.m/" /var/lib/jenkins/workspace/Jenkins-Laravel/.env'
                sh 'sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=mahesh123/" /var/lib/jenkins/workspace/Jenkins-Laravel/.env'
            }
        }

        stage('Build App') {
            steps {
                sh 'composer install'
                sh 'php artisan key:generate'
                sh 'php artisan build'
            }
        }

        stage('Zipping project') {
            steps {
                sh 'zip -r project.zip .'
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                sh 'scp -i /var/lib/jenkins/.ssh/jenkins_rsa project.zip ubuntu@13.201.8.1:/var/www/project.zip'
            }
        }

        stage('Extracting Project') {
            steps {
                sh 'ssh -i /var/lib/jenkins/.ssh/jenkins_rsa ubuntu@13.201.8.1 "cd /var/www/ && unzip -o project.zip"'
            }
        }
    }
}
