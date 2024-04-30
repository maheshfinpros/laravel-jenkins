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

        stage('Prepare Environment') {
            steps {
                script {
                    try {
                        sh 'sed -i "s/DB_HOST=.*/DB_HOST=127.0.0.1/" /var/www/Jenkins-Laravel/.env'
                        sh 'sed -i "s/DB_PORT=.*/DB_PORT=3306/" /var/www/Jenkins-Laravel/.env'
                        sh 'sed -i "s/DB_DATABASE=.*/DB_DATABASE=maheshfinpros/" /var/www/Jenkins-Laravel/.env'
                        sh 'sed -i "s/DB_USERNAME=.*/DB_USERNAME=mahesh.m/" /var/www/Jenkins-Laravel/.env'
                        sh 'sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=mahesh123/" /var/www/Jenkins-Laravel/.env'
                    } catch (Exception e) {
                        error "Failed to prepare environment: ${e.message}"
                    }
                }
            }
        }

        stage('Build App') {
            steps {
                script {
                    try {
                        sh 'cd /var/www/Jenkins-Laravel && composer install' // Install dependencies
                        sh 'cd /var/www/Jenkins-Laravel && php artisan key:generate' // Generate application key
                        sh 'cd /var/www/Jenkins-Laravel && php artisan build' // Build application
                    } catch (Exception e) {
                        error "Failed to build the application: ${e.message}"
                    }
                }
            }
        }

        stage('Zipping project') {
            steps {
                script {
                    try {
                        sh 'cd /var/www && zip -r project.zip Jenkins-Laravel' // Zip the project
                    } catch (Exception e) {
                        error "Failed to zip the project: ${e.message}"
                    }
                }
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                script {
                    try {
                        sh 'scp -i /var/lib/jenkins/.ssh/jenkins_rsa /var/www/project.zip ubuntu@13.201.8.1:/var/www/project.zip' // Upload artifact
                    } catch (Exception e) {
                        error "Failed to upload artifact to the target server: ${e.message}"
                    }
                }
            }
        }

        stage('Extracting Project') {
            steps {
                script {
                    try {
                        sh 'ssh ubuntu@13.201.8.1 "cd /var/www && unzip -o project.zip"' // Extract the project
                    } catch (Exception e) {
                        error "Failed to extract the project: ${e.message}"
                    }
                }
            }
        }
    }
}
