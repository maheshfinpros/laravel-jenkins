pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                // Checkout the code from SCM
                checkout scm
            }
        }
        
        stage('Install Dependencies') {
            steps {
                // Change directory to the Laravel project
                dir('path/to/laravel/project') {
                    // Run composer install
                    sh 'composer install'
                }
            }
        }
        
        // Add more stages as needed for testing, building, deploying, etc.
    }
    
    post {
        always {
            // Clean up after the build
            deleteDir()
        }
    }
}

