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
                        // Check if the .env file exists before modifying it
                        if (fileExists('/var/www/.env')) {
                            // Update .env file
                            sh 'sed -i "s/DB_HOST=.*/DB_HOST=127.0.0.1/" /var/www/.env'
                            sh 'sed -i "s/DB_PORT=.*/DB_PORT=3306/" /var/www/.env'
                            sh 'sed -i "s/DB_DATABASE=.*/DB_DATABASE=maheshfinpros/" /var/www/.env'
                            sh 'sed -i "s/DB_USERNAME=.*/DB_USERNAME=mahesh.m/" /var/www/.env'
                            sh 'sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=mahesh123/" /var/www/.env'
                        } else {
                            error "The .env file does not exist."
                        }
                    } catch (Exception e) {
                        error "Failed to prepare environment: ${e.message}"
                    }
                }
            }
        }

        // Add other stages as needed
    }
}

def fileExists(filePath) {
    def file = new File(filePath)
    return file.exists()
}
