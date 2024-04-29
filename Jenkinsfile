jenkinsfile_content = """
pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                // Checkout the code from your GitHub repository
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }

        stage('Build App') {
            steps {
                // Build your Laravel application
                sh 'composer install'
                sh 'php artisan build'
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
"""
