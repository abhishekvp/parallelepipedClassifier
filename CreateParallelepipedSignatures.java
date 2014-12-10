 import java.awt.Color;
 import java.awt.image.BufferedImage;
 import java.io.BufferedReader;
 import java.io.BufferedWriter;
 import java.io.File;
 import java.io.FileReader;
 import java.io.FileWriter;
 import java.io.IOException;
 import java.util.StringTokenizer;
 import java.util.TreeMap;
  
 import javax.imageio.ImageIO;
  
 public final class CreateParallelepipedSignatures
   {

   public static void main(String[] args) throws IOException
     {
     // Check parameters names.
     if (args.length != 3)
       {
       System.err.println("Must pass three command-line parameters to this application:");
       System.err.println(" - The original image (from which samples will be extracted;");
       System.err.println(" - The file with the classes names and colors");
       System.err.println(" - The file with the samples coordinates");
       System.exit(1);
       }
     // Open the original image.
     BufferedImage input = ImageIO.read(new File(args[0]));
     // Read the classes description file. 
     BufferedReader br = new BufferedReader(new FileReader(args[1]));
     // Store the classes color in a map.
     TreeMap<Integer,Color> classMap = new TreeMap<Integer, Color>();
     while(true)
       {
       String line = br.readLine(); 
       if (line == null) break;
       if (line.startsWith("#")) continue;
       StringTokenizer st = new StringTokenizer(line);
       if (st.countTokens() < 4) continue;
       int classId = Integer.parseInt(st.nextToken());
       int r = Integer.parseInt(st.nextToken());
       int g = Integer.parseInt(st.nextToken());
       int b = Integer.parseInt(st.nextToken());
       classMap.put(classId,new Color(r,g,b));
       }
     br.close();
     // Create the structures to represent the bounds for the parallelepipeds,
     // one for each class. Behold the power of the Collections!
     TreeMap<Integer,int[]> minMap = new TreeMap<Integer, int[]>();
     TreeMap<Integer,int[]> maxMap = new TreeMap<Integer, int[]>();
     for(Integer classIndex:classMap.keySet())
       {
       minMap.put(classIndex,new int[]{1000,1000,1000}); // large enough
       maxMap.put(classIndex,new int[]{-1,-1,-1}); // small enough
       }
     // Open the file with the coordinates and get the pixels' values for those 
     // coordinates.
     br = new BufferedReader(new FileReader(args[2]));
     while(true)
       {
       String line = br.readLine(); 
       if (line == null) break;
       if (line.startsWith("#")) continue;
       StringTokenizer st = new StringTokenizer(line);
       if (st.countTokens() < 5) continue;
       int classId = Integer.parseInt(st.nextToken());
       int x = Integer.parseInt(st.nextToken());
       int y = Integer.parseInt(st.nextToken());
       int w = Integer.parseInt(st.nextToken());
       int h = Integer.parseInt(st.nextToken());
       Color c = classMap.get(classId);
       if (c != null) // We have a region!
         {
         // Get the bounds for this region.
         int[] min = minMap.get(classId);
         int[] max = maxMap.get(classId);
         // Let's get all pixels values in it.
         for(int row=0;row<=h;row++)
           for(int col=0;col<=w;col++)
             {
             int rgb = input.getRGB(x+col,y+row);
             int r = (int)((rgb&0x00FF0000)>>>16); // Red level
             int g = (int)((rgb&0x0000FF00)>>>8);  // Green level
             int b = (int) (rgb&0x000000FF);       // Blue level
             // Use those values to adjust the bounds for the parallelepipeds.
             min[0] = Math.min(min[0],r);  max[0] = Math.max(max[0],r);
             min[1] = Math.min(min[1],g);  max[1] = Math.max(max[1],g);
             min[2] = Math.min(min[2],b);  max[2] = Math.max(max[2],b);
             } 
         // Put the bounds back on the map.
         minMap.put(classId,min);
         maxMap.put(classId,max);
         }
       }
     br.close();
     // The values on the maps are the bounds for each class. Let's save them
     // to a file so we can reuse them in the classifier.
     BufferedWriter bw = new BufferedWriter(new FileWriter("new_parallel_signatures.txt"));
     // In each line information for a class.
     for(Integer classId:classMap.keySet())
       {
       bw.write(classId+" ");
       int[] min = minMap.get(classId);
       int[] max = maxMap.get(classId);
       bw.write(min[0]+" "+min[1]+" "+min[2]+" ");
       bw.write(max[0]+" "+max[1]+" "+max[2]+" ");
       bw.newLine();      
       }
     bw.close();
     }
   } 
