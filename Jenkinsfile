pipeline {
    agent any

    stages {
        stage('Checkout Repo') {
            steps {
                // Checkout the code from your GitHub repository
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
                echo 'Code checked out from GitHub repository'
            }
        }

        stage('Build App') {
            steps {
                // Build your Laravel application
                sh 'composer install'
                sh 'php artisan build'
                echo 'Laravel application built successfully'
            }
        }

        stage('Zipping project') {
            steps {
                // Zip your entire repository files
                sh 'zip -r project.zip .'
                echo 'Repository files zipped successfully'
            }
        }

        stage('Upload Artifact to Target Server') {
            steps {
                // Upload zip file to remote server's /var/www directory
                sh 'scp -i /var/lib/jenkins/.ssh/jenkins_rsa project.zip ubuntu@13.201.8.1:/var/www/project.zip'
                echo 'Artifact uploaded to target server successfully'
            }
        }

        stage('Extracting Project') {
            steps {
                // Extract zip file on the target server
                sh 'ssh -i /var/lib/jenkins/.ssh/jenkins_rsa ubuntu@13.201.8.1 "cd /var/www/ && unzip -o project.zip"'
                echo 'Project extracted on the target server'
            }
        }
    }
}
