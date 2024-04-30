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
    }
}
