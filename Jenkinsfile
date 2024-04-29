pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Build App') {
            steps {
                sh 'ls -la /var/lib/jenkins/workspace/Jenkins-Laravel/' // Check directory contents for debugging
                sh 'cat /var/lib/jenkins/workspace/Jenkins-Laravel/.env' // Check .env file contents for debugging
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

    post {
        always {
            echo 'Pipeline execution completed.'
        }
    }
}
