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
                // Navigate to the project directory
                dir('laravel-jenkins') {
                    // Run composer install
                    sh 'composer install'
                }
            }
        }
    }
}
