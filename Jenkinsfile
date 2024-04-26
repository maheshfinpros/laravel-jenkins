pipeline {
    agent any
    
    stages {
        stage('Install Apache') {
            steps {
                script {
                    sshCommand remote: 'ssh-remoteserver', command: 'sudo apt update && sudo apt install -y apache2'
                }
            }
        }
    }
}
