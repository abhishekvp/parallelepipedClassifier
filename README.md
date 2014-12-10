Parallelepiped Classifier Web Application for Image Classification
------------------------------------------------------------------
Parallelepiped Classifier uses a Supervised Classification approach. So it requires training data to be able to classify pixels into classes. This WebApp is written in PHP and Java. It makes use of HTML5 Canvas to interactively help the user create the Training Data File(Sample Data File).

PHP is used to upload the input image, create the Training Data File(Sample Data File) and finally render the classified image. A java program(used as jar) is used to create a Signature File from the Training Data File and process the image using that file to generate the classified output image.

Requirements to deploy the application:
* JDK
* PHP Server - LAMPP/XAMPP
* Modern Browser - Mozilla Firefox / Google Chrome

Screenshots:
------------
![Main Page](https://raw.github.com/abhishekvp/parallelepipedClassifier/master/Screenshots/Main.png)
Main Page

![Training Data Creation](https://raw.github.com/abhishekvp/parallelepipedClassifier/master/Screenshots/TrainingData Creation.png)
Training Data Creation

![Classification Result](https://raw.github.com/abhishekvp/parallelepipedClassifier/master/Screenshots/ClassifiedImage.png)
Classification Result

References:
-----------
* Parallelepiped Classifier Concept and Java Implementation          
  http://www.lac.inpe.br/JIPCookbook/7020-tutorial-supervisedclassification.jsp#tutorialsabrieftutorialonsupervisedimageclassificationtheparallelepipedclassifier
