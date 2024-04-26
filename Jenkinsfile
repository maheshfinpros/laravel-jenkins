pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Checkout the code to the workspace directory
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Composer Install') {
            steps {
                // Navigate to the Laravel project directory
                dir('path/to/laravel/project') {
                    // Run composer install
                    sh 'composer install'
                }
            }
        }
    }
}
