pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                // Checkout your source code from Git
                git 'https://github.com/maheshfinpros/laravel-jenkins.git'
            }
        }
        stage('Install Apache') {
            steps {
                script {
                    // Define the SSH credentials to use for connecting to the remote server
                    def sshCredentials = credentials('ssh-remoteserver')
                    
                    // Define the SSH command to execute on the remote server
                    def sshCommand = "sudo apt update && sudo apt install -y apache2"
                    
                    // Execute the SSH command on the remote server
                    sshCommand remote: [
                        host: '3.110.147.246',
                        user: 'ubuntu',
                        credentialsId: sshCredentials,
                        command: sshCommand
                    ]
                }
            }
        }
    }
}
